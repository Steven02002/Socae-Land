<?php

namespace Controllers;

use Classes\Pagination;
use Model\Category;
use Model\Event;
use Model\Location;
use Model\Speaker;
use MVC\Router;

class EventosController
{

    public static function index(Router $router)
    {
        if(!is_admin()) {
            header('Location: /login');
          }
        $actual_page = $_GET['page'];
        $actual_page = filter_var($actual_page, FILTER_VALIDATE_INT);

        if (!$actual_page || $actual_page < 1) {
            header('Location: /admin/eventos?page=1');
        }

        $records_per_page = 10;
        $total_records = Event::total();
        $pagination = new Pagination($actual_page, $records_per_page, $total_records);

        $events = Event::paginate($records_per_page, $pagination->offset());

        foreach ($events as $event) {
            $event->category = Category::find($event->category_id);

            $event->speaker = Speaker::find($event->speaker_id);
        }

        $router->render('admin/eventos/index', [
            'title' => 'Eventos',
            'events' => $events,
            'pagination' => $pagination->pagination()
        ]);
    }

    public static function create(Router $router)
    {
        if(!is_admin()) {
            header('Location: /login');
          }
        $alerts = [];

        $categories = Category::all();

        $event = new Event;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $event->synchronize($_POST);
            $alerts = $event->validate();

            if (empty($alerts)) {
                $result = $event->save();
                if ($result) {
                    header('Location: /admin/eventos');
                }
            }
        }

        $router->render('admin/eventos/create', [
            'title' => 'Registar Evento',
            'alerts' => $alerts,
            'categories' => $categories,
            'event' => $event
        ]);
    }

    public static function edit(Router $router)
    {
        if(!is_admin()) {
            header('Location: /login');
          }
        $alerts = [];

        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if (!$id) {
            header('Location: /admin/eventos');
        }

        $categories = Category::all();

        $event = Event::find($id);
        if (!$event) {
            header('Location: /admin/eventos');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if(!is_admin()) {
                header('Location: /login');
              }
            $event->synchronize($_POST);
            $alerts = $event->validate();

            if (empty($alerts)) {
                $result = $event->save();
                if ($result) {
                    header('Location: /admin/eventos');
                }
            }
        }

        $router->render('admin/eventos/edit', [
            'title' => 'Editar Evento',
            'alerts' => $alerts,
            'categories' => $categories,
            'event' => $event
        ]);
    }

    public static function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(!is_admin()) {
                header('Location: /login');
              }
            $id = $_POST['id'];

            $event = Event::find($id);

            if (!isset($event)) {
                header('Location: /admin/eventos');
            }

            $result = $event->eliminar();

            if ($result) {
                header('Location: /admin/eventos');
            }
        }
    }

}