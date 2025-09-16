<?php
    namespace Model;
class EventHorary extends ActiveRecord {
    protected static $table = 'events';
    protected static $columnsDB = ['id', 'category_id', 'day_id', 'hour_id'];
    public $id;
    public $category_id;
    public $day_id;
    public $hour_id;

}