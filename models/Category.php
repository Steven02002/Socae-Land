<?php
    namespace Model;
class Category extends ActiveRecord {
    protected static $table = 'categories';
    protected static $columnsDB = ['id', 'category_name'];
    public $id;
    public $category_name;
}