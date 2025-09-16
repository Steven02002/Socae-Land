<?php

namespace Controllers;

class APIEvents {
    public static function index() {
        $category_id = $_GET['category_id'] ?? '';

        $category_id = filter_var($category_id, FILTER_VALIDATE_INT);

        if(!$day_id || !$category_id) {
            echo json_encode ([]);
            return;
        }

    }
}