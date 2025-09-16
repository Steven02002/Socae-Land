<?php

namespace Model;

class Usuario extends ActiveRecord {
    protected static $table = 'users';
    protected static $columnsDB = ['id', 'first_name', 'last_name', 'email', 'password', 'confirmed', 'token', 'admin'];
    
    // public $id;
    // public $first_name;
    // public $last_name;
    // public $email;
    // public $password;
    // public $confirmed;
    // public $token;
    // public $admin;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->first_name = $args['first_name'] ?? '';
        $this->last_name = $args['last_name'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->password2 = $args['password2'] ?? '';
        $this->confirmed = $args['confirmed'] ?? 0;
        $this->token = $args['token'] ?? '';
        $this->admin = $args['admin'] ?? 1;
    }

    // Validar el Login de Usuarios
    public function validarLogin() {
        if(!$this->email) {
            self::$alerts['error'][] = 'El Email del Usuario es Obligatorio';
        }
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            self::$alerts['error'][] = 'Email no válido';
        }
        if(!$this->password) {
            self::$alerts['error'][] = 'La contraseña no puede estar vacía';
        }
        return self::$alerts;

    }

    // Validación para cuentas nuevas
    public function validar_cuenta() {
        if(!$this->first_name) {
            self::$alerts['error'][] = 'El Nombre es Obligatorio';
        }
        if(!$this->last_name) {
            self::$alerts['error'][] = 'El Apellido es Obligatorio';
        }
        if(!$this->email) {
            self::$alerts['error'][] = 'El Email es Obligatorio';
        }
        if(!$this->password) {
            self::$alerts['error'][] = 'La contraseña no puede estar vacía';
        }
        if(strlen($this->password) < 6) {
            self::$alerts['error'][] = 'La contraseña debe contener al menos 6 caracteres';
        }
        if($this->password !== $this->password2) {
            self::$alerts['error'][] = 'Los contraseñas son diferentes';
        }
        return self::$alerts;
    }

    // Valida un email
    public function validarEmail() {
        if(!$this->email) {
            self::$alerts['error'][] = 'El Email es Obligatorio';
        }
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            self::$alerts['error'][] = 'Email no válido';
        }
        return self::$alerts;
    }

    // Valida el Password 
    public function validarPassword() {
        if(!$this->password) {
            self::$alerts['error'][] = 'La contraseña no puede estar vacía';
        }
        if(strlen($this->password) < 6) {
            self::$alerts['error'][] = 'La contraseña debe contener al menos 6 caracteres';
        }
        return self::$alerts;
    }

    public function nuevo_password() : array {
        if(!$this->password_actual) {
            self::$alerts['error'][] = 'La contraseña actual no puede estar vacía';
        }
        if(!$this->password_nuevo) {
            self::$alerts['error'][] = 'La nueva contraseña no puede estar vacía';
        }
        if(strlen($this->password_nuevo) < 6) {
            self::$alerts['error'][] = 'La contraseña debe contener al menos 6 caracteres';
        }
        return self::$alerts;
    }

    // Comprobar el password
    public function comprobar_password() : bool {
        return password_verify($this->password_actual, $this->password );
    }

    // Hashea el password
    public function hashPassword() : void {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    // Generar un Token
    public function crearToken() : void {
        $this->token = uniqid();
    }
}