<?php
    namespace Model;
class Area extends ActiveRecord {
    protected static $table = 'areas';
    protected static $columnsDB = ['id', 'name_area'];
    public $id;
    public $name_area;
}