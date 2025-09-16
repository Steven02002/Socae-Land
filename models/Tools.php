<?php

namespace Model;

class Tools extends ActiveRecord
{
    protected static $table = 'tools';
    protected static $columnsDB = ['id', 'title', 'description', 'image', 'link'];

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->title = $args['title'] ?? '';
        $this->description = $args['description'] ?? '';
        $this->image = $args['image'] ?? '';
        $this->link = $args['link'] ?? '';
    }

    public function validate() {
        if(!$this->title) {
            self::$alerts['error'][] = 'El titulo es obligatorio';
        }
        if(!$this->description) {
            self::$alerts['error'][] = 'La descripción es obligatoria';
        }
        if(!$this->image) {
            self::$alerts['error'][] = 'La imagen es obligatoria';
        }
        if(!$this->link) {
            self::$alerts['error'][] = 'El link es obligatoria';
        }
        return self::$alerts;
    }
}