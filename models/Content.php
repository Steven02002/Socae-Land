<?php

namespace Model;

class Content extends ActiveRecord {
    protected static $table = 'contents';
    protected static $columnsDB = ['id', 'title', 'content_name', 'description', 'subtitle', 'image1', 'image2'];

    public $id;
    public $title;
    public $content_name;
    public $description;
    public $subtitle;
    public $image1;
    public $image2;

    public function __construct($args = [])
    {   $this->id = $args['id'] ?? null;
        $this->title = $args['title'] ?? '';
        $this->content_name = $args['content_name'] ?? '';
        $this->description = $args['description'] ?? '';
        $this->subtitle = $args['subtitle'] ?? '';
        $this->image1 = $args['image1'] ?? '';
        $this->image2 = $args['image2'] ?? '';
    }
}