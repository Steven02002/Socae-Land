<?php

namespace Model;

class News extends ActiveRecord
{
    protected static $table = 'news';
    protected static $columnsDB = ['id', 'title', 'description', 'image', 'link','category_id'];

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->title = $args['title'] ?? '';
        $this->description = $args['description'] ?? '';
        $this->image = $args['image'] ?? '';
        $this->link = $args['link'] ?? '';
        $this->category_id = $args['category_id'] ?? '';
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
            self::$alerts['error'][] = 'El link es obligatorio';
        }
        return self::$alerts;
    }
}