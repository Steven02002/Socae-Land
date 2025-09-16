<?php

namespace Model;

class Activity extends ActiveRecord {
    protected static $table = 'activities';
    protected static $columnsDB = ['id', 'image', 'description'];

    public $id;
    public $image;
    public $description;

    public function __construct($args = [])
    {   $this->id = $args['id'] ?? null;
        $this->image = $args['image'] ?? '';
        $this->description = $args['description'] ?? '';
    }

    public function validate() {
        if(!$this->image) {
            self::$alerts['error'][] = 'La imagen es obligatoria';
        }
        if(!$this->description) {
            self::$alerts['error'][] = 'La descripción es Obligatoria';
        }
        return self::$alerts;
    }
}