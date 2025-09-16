<?php

namespace Model;

class Speaker extends ActiveRecord
{
  protected static $table = 'speakers';
  protected static $columnsDB = ['id', 'first_name', 'last_name', 'city', 'country', 'image', 'tags', 'social_medias'];

  public function __construct($args = [])
  {
    $this->id = $args['id'] ?? null;
    $this->first_name = $args['first_name'] ?? '';
    $this->last_name = $args['last_name'] ?? '';
    $this->city = $args['city'] ?? '';
    $this->country = $args['country'] ?? '';
    $this->image = $args['image'] ?? '';
    $this->tags = $args['tags'] ?? '';
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
    if (!$this->city) {
      self::$alerts['error'][] = 'El Campo Ciudad es Obligatorio';
    }
    if (!$this->country) {
      self::$alerts['error'][] = 'El Campo País es Obligatorio';
    }
    if (!$this->image) {
      self::$alerts['error'][] = 'La imagen es obligatoria';
    }
    if (!$this->tags) {
      self::$alerts['error'][] = 'El Campo áreas es obligatorio';
    }

    return self::$alerts;
  }
}
