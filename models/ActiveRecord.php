<?php

namespace Model;

class ActiveRecord
{

  // Base DE DATOS
  protected static $db;
  protected static $table = '';
  protected static $columnsDB = [];

  // alerts y Mensajes
  protected static $alerts = [];

  // Definir la conexión a la BD - includes/database.php
  public static function setDB($database)
  {
    self::$db = $database;
  }

  // Setear un tipo de Alerta
  public static function setAlert($tipo, $mensaje)
  {
    static::$alerts[$tipo][] = $mensaje;
  }

  // Obtener las alerts
  public static function getAlerts()
  {
    return static::$alerts;
  }

  // Validación que se hereda en modelos
  public function validate()
  {
    static::$alerts = [];
    return static::$alerts;
  }

  // Consulta SQL para crear un objeto en Memoria (Active Record)
  public static function consultarSQL($query)
  {
    // Consultar la base de datos
    $result = self::$db->query($query);

    // Iterar los results
    $array = [];
    while ($registro = $result->fetch_assoc()) {
      $array[] = static::crearObjeto($registro);
    }

    // liberar la memoria
    $result->free();

    // retornar los results
    return $array;
  }

  // Crea el objeto en memoria que es igual al de la BD
  protected static function crearObjeto($registro)
  {
    $objeto = new static;

    foreach ($registro as $key => $value) {
      if (property_exists($objeto, $key)) {
        $objeto->$key = $value;
      }
    }
    return $objeto;
  }

  // Identificar y unir los atributos de la BD
  public function atributos()
  {
    $atributos = [];
    foreach (static::$columnsDB as $columna) {
      if ($columna === 'id') continue;
      $atributos[$columna] = $this->$columna;
    }
    return $atributos;
  }

  // Sanitizar los datos antes de guardarlos en la BD
  public function sanitizarAtributos()
  {
    $atributos = $this->atributos();
    $sanitizado = [];
    foreach ($atributos as $key => $value) {
      $sanitizado[$key] = self::$db->escape_string($value);
    }
    return $sanitizado;
  }

  // Sincroniza BD con Objetos en memoria
  public function synchronize($args = [])
  {
    foreach ($args as $key => $value) {
      if (property_exists($this, $key) && !is_null($value)) {
        $this->$key = $value;
      }
    }
  }

  // Registros - CRUD
  public function save()
  {
    $result = '';
    if (!is_null($this->id)) {
      // actualizar
      $result = $this->actualizar();
    } else {
      // Creando un nuevo registro
      $result = $this->create();
    }
    return $result;
  }

  // Obtener todos los Registros
  public static function all($orden = 'DESC')
  {
    $query = "SELECT * FROM " . static::$table . " ORDER BY id ${orden}";
    $resultado = self::consultarSQL($query);
    return $resultado;
  }

  // Busca un registro por su id
  public static function find($id)
  {
    $query = "SELECT * FROM " . static::$table  . " WHERE id = ${id}";
    $result = self::consultarSQL($query);
    return array_shift($result);
  }

  // Obtener Registros con cierta cantidad
  public static function get($limite)
  {
    $query = "SELECT * FROM " . static::$table . " LIMIT ${limite} ORDER BY id DESC";
    $result = self::consultarSQL($query);
    return array_shift($result);
  }

  // Metodo para paginas los registros
  public static function paginate($per_page, $offset) {
    $query = "SELECT * FROM " . static::$table . " ORDER BY id DESC LIMIT ${per_page} OFFSET ${offset} ";
    $result = self::consultarSQL($query);
    return $result;
  }

  // Busqueda Where con Columna 
  public static function where($columna, $valor)
  {
    $query = "SELECT * FROM " . static::$table . " WHERE ${columna} = '${valor}'";
    $result = self::consultarSQL($query);
    return array_shift($result);
  }

  //retornar los registros por orden
  public static function order($columna, $orden) {
    $query = "SELECT * FROM " . static::$table . " ORDER BY ${columna} ${orden} ";
    $result = self::consultarSQL($query);
    return $result;
  }

  // Busqueda Where con multiples opciones
  public static function whereArray($array= []) {
    $query = "SELECT * FROM " . static::$table . " WHERE ";
    foreach($array as $key => $value) {
      if($key == array_key_last($array)) {
        $query .= " ${key} = '${value}'";
      } else {
        $query .= " ${key} = '${value}' AND ";
      }
    }
    $resultado = self::consultarSQL($query);
    return $resultado;
  }
  
  // Traer un total de registros
  public static function total($columna = '', $valor = '') {
    $query = "SELECT COUNT(*) FROM " . static::$table;
    if($columna) {
      $query .= " WHERE ${columna} = ${valor}";
    }
    $result = self::$db->query($query);
    $total = $result->fetch_array();

    return array_shift($total);
  }

  // crea un nuevo registro
  public function create()
  {
    // Sanitizar los datos
    $atributos = $this->sanitizarAtributos();
    // debuguear($atributos);
    // Insertar en la base de datos
    $query = " INSERT INTO " . static::$table . " ( ";
    $query .= join(', ', array_keys($atributos));
    $query .= " ) VALUES ('";
    $query .= join("', '", array_values($atributos));
    $query .= "') ";

    //debuguear($query); // Descomentar si no te funciona algo

    // result de la consulta
    $result = self::$db->query($query);
    return [
      'result' =>  $result,
      'id' => self::$db->insert_id
    ];
  }

  // Actualizar el registro
  public function actualizar()
  {
    // Sanitizar los datos
    $atributos = $this->sanitizarAtributos();

    // Iterar para ir agregando cada campo de la BD
    $valores = [];
    foreach ($atributos as $key => $value) {
      $valores[] = "{$key}='{$value}'";
    }

    // Consulta SQL
    $query = "UPDATE " . static::$table . " SET ";
    $query .=  join(', ', $valores);
    $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
    $query .= " LIMIT 1 ";

    // Actualizar BD
    $result = self::$db->query($query);
    return $result;
  }

  // Eliminar un Registro por su ID
  public function eliminar()
  {
    $query = "DELETE FROM "  . static::$table . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
    $result = self::$db->query($query);
    return $result;
  }
}
