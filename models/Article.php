<?php

namespace Model;

class Article extends ActiveRecord
{
  protected static $table = 'articles';
  protected static $columnsDB = ['id', 'title_article', 'description_article', 'url_article'];

  public $id;
  public $title_article;
  public $description_article;
  public $url_article;

  public function __construct($args = [])
  {
    $this->id = $args['id'] ?? null;
    $this->title_article = $args['title_article'] ?? '';
    $this->description_article = $args['description_article'] ?? '';
    $this->url_article = $args['url_article'] ?? '';
  }


  public function validate()
  {
    if (!$this->title_article) {
      self::$alerts['error'][] = 'El título del artículo es obligatorio';
    }
    if (!$this->description_article) {
      self::$alerts['error'][] = 'La descripción del artículo es obligatoria';
    }
    if (!$this->url_article) {
      self::$alerts['error'][] = 'El enlace del artículo es obligatoria';
    }
    return self::$alerts;
  }
}
