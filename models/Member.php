<?php

namespace Model;

class Member extends ActiveRecord
{
  protected static $table = 'members';
  protected static $columnsDB = ['id', 'area_id', 'first_name', 'last_name', 'image', 'social_medias'];

  public $id;
  public $area_id;
  public $first_name;
  public $last_name;
  public $image;
  public $social_medias;

  public function __construct($args = [])
  {
    $this->id = $args['id'] ?? null;
    $this->area_id = $args['area_id'] ?? '';
    $this->first_name = $args['first_name'] ?? '';
    $this->last_name = $args['last_name'] ?? '';
    $this->image = $args['image'] ?? '';
    $this->social_medias = $args['social_medias'] ?? '';
  }


  public function validate()
  {
    if (!$this->first_name) {
      self::$alerts['error'][] = 'El Nombre es Obligatorio';
    }
    if (!$this->last_name) {
      self::$alerts['error'][] = 'El Apellido es Obligatorio';
    }
    if (!$this->area_id) {
      self::$alerts['error'][] = 'Debe seleccionar su área';
    }
    if (!$this->image) {
      self::$alerts['error'][] = 'La imagen es obligatoria';
    }
    return self::$alerts;
  }
}
