<?php

namespace MVC;

class Router
{
    public array $getRoutes = [];
    public array $postRoutes = [];

    public function get($url, $fn)
    {
        $this->getRoutes[$url] = $fn;
    }

    public function post($url, $fn)
    {
        $this->postRoutes[$url] = $fn;
    }

    public function comprobarRutas()
    {
        $currentUrl = $_SERVER['REQUEST_URI'] ?? '/';
        // Elimina Query Strings (ej: ?id=1) de la URL para que no interfieran
        $url_actual = strtok($currentUrl, '?');
        $method = $_SERVER['REQUEST_METHOD'];

        if ($method === 'GET') {
            $fn = $this->getRoutes[$url_actual] ?? null;
        } else {
            $fn = $this->postRoutes[$url_actual] ?? null;
        }

        if ( $fn ) {
            // La URL existe y hay una función asociada
            call_user_func($fn, $this);
        } else {
            // URL no encontrada
            header('Location: /404');
        }
    }

    public function render($view, $datos = [])
    {
        foreach ($datos as $key => $value) {
            $$key = $value; 
        }

        ob_start(); 

        include_once __DIR__ . "/views/$view.php";

        $contenido = ob_get_clean(); // Limpia el Buffer

        //Utilizar el layout de acuerdo con la URL
        $url_actual = $_SERVER['PATH_INFO'] ?? '/';

        if(str_contains($url_actual, '/admin')) {
            include_once __DIR__ . '/views/admin-layout.php';
        }else {
            include_once __DIR__ . '/views/layout.php';
        }
    }
}
