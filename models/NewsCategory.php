<?php

namespace Model;

class NewsCategory extends ActiveRecord
{
    protected static $table = 'news_categories';
    protected static $columnsDB = ['id', 'category_name'];

    public $id;
    public $category_name;
}