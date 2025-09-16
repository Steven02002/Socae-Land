<?php

namespace Model;

class Material extends ActiveRecord
{
  protected static $table = 'materials';
  protected static $columnsDB = ['id', 'name_material', 'url_material', 'image'];

  public $id;
  public $name_material;
  public $url_material;
  public $image;

  public function __construct($args = [])
  {
    $this->id = $args['id'] ?? null;
    $this->name_material = $args['name_material'] ?? '';
    $this->url_material = $args['url_material'] ?? '';
    $this->image = $args['image'] ?? '';
  }


  public function validate()
  {
    if (!$this->name_material) {
      self::$alerts['error'][] = 'El Nombre del material es obligatorio';
    }
    if (!$this->url_material) {
      self::$alerts['error'][] = 'El enlace del material es obligatorio';
    }
    if (!$this->image) {
      self::$alerts['error'][] = 'La imagen es obligatoria';
    }
    return self::$alerts;
  }
}
