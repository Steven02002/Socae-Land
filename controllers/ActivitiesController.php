<?php

namespace Controllers;

use Model\Activity;
use Classes\Pagination;
use MVC\Router;
use Intervention\Image\ImageManagerStatic as Image;

class ActivitiesController
{

    public static function index(Router $router)
    {
        if (!is_admin()) {
            header('Location: /login');
        }
        $actual_page = $_GET['page'];
        $actual_page = filter_var($actual_page, FILTER_VALIDATE_INT);

        if (!$actual_page || $actual_page < 1) {
            header('Location: /admin/activities?page=1');
        }

        $records_per_page = 10;
        $total_records = Activity::total();
        $pagination = new Pagination($actual_page, $records_per_page, $total_records);

        $activities = Activity::paginate($records_per_page, $pagination->offset());

        //debuguear($activities);

        if ($pagination->total_pages() < $actual_page) {
            header('Location: /admin/activities?page=1');
        }

        if (!is_admin()) {
            header('Location: /login');
        }

        $router->render('admin/activities/index', [
            'title' => 'Actividades',
            'activities' => $activities,
            'pagination' => $pagination->pagination()
        ]);
    }

    public static function create(Router $router)
    {
        if (!is_admin()) {
            header('Location: /login');
        }
        $alerts = [];
        $activity = new Activity;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Leer imagen
            if (!empty($_FILES['image']['tmp_name'])) {
                $folder_images = '../public/img/activities';

                // Crear la carpeta si no existe
                if (!is_dir($folder_images)) {
                    mkdir($folder_images, 0755, true);
                }

                $image_png = Image::make($_FILES['image']['tmp_name'])->fit(900, 900)->encode('png', 80);
                $image_webp = Image::make($_FILES['image']['tmp_name'])->fit(900, 900)->encode('webp', 80);

                $image_name = md5(uniqid(rand(), true));

                $_POST['image'] = $image_name;
            }

            $activity->synchronize($_POST);

            $alerts = $activity->validate();

            // Guardar el registro
            if (empty($alerts)) {
                // Guardar imagenes
                $image_png->save($folder_images . '/' . $image_name . '.png');
                $image_webp->save($folder_images . '/' . $image_name . '.webp');

                // Guardar en la DB
                $result = $activity->save();
                // debuguear($result);

                if ($result) {
                    header('Location: /admin/activities');
                }
            }
        }

        $router->render('admin/activities/create', [
            'title' => 'Crear actividad',
            'alerts' => $alerts,
            'activity' => $activity
        ]);
    }

    public static function edit(Router $router)
    {
        if (!is_admin()) {
            header('Location: /login');
        }
        $alerts = [];
        // Validar id
        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if (!$id) {
            header('Location: /admin/news');
        }

        // Obtener expositor a editar
        $activity = Activity::find($id);

        //debuguear($speaker);

        if (!$activity) {
            header('Location: /admin/activities');
        }

        $activity->current_image = $activity->image;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!is_admin()) {
                header('Location: /login');
            }
            if (!empty($_FILES['image']['tmp_name'])) {
                $folder_images = '../public/img/activities';

                // Crear la carpeta si no existe
                if (!is_dir($folder_images)) {
                    mkdir($folder_images, 0755, true);
                }

                $oldPngImage = $folder_images . '/' . $activity->current_image . '.png';
                $oldWebpImage = $folder_images . '/' . $activity->current_image . '.webp';
                if (file_exists($oldPngImage)) {
                    unlink($oldPngImage);
                }
                if (file_exists($oldWebpImage)) {
                    unlink($oldWebpImage);
                }

                $image_png = Image::make($_FILES['image']['tmp_name'])->fit(900, 900)->encode('png', 80);
                $image_webp = Image::make($_FILES['image']['tmp_name'])->fit(900, 900)->encode('webp', 80);

                $image_name = md5(uniqid(rand(), true));

                $_POST['image'] = $image_name;
            } else {
                $_POST['image'] = $activity->current_image;
            }

            $_POST['social_medias'] = json_encode($_POST['social_medias'], JSON_UNESCAPED_SLASHES);

            $activity->synchronize($_POST);

            $alerts = $activity->validate();

            if (empty($alerts)) {
                if (isset($image_name)) {
                    $image_png->save($folder_images . '/' . $image_name . '.png');
                    $image_webp->save($folder_images . '/' . $image_name . '.webp');
                }

                $result = $activity->save();

                if ($result) {
                    header('Location: /admin/activities');
                }
            }
        }

        $router->render('admin/activities/edit', [
            'title' => 'Editar actividad',
            'alerts' => $alerts,
            'activity' => $activity,
        ]);
    }

    public static function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!is_admin()) {
                header('Location: /login');
            }
            $id = $_POST['id'];

            $activity = Activity::find($id);

            if (!isset($new)) {
                header('Location: /admin/activities');
            }

            $folder_images = '../public/img/activities';
            $pngImage = $folder_images . '/' . $activity->image . '.png';
            $webpImage = $folder_images . '/' . $activity->image . '.webp';
            if (file_exists($pngImage)) {
              unlink($pngImage);
            }
            if (file_exists($webpImage)) {
              unlink($webpImage);
            }

            $result = $activity->eliminar();

            if ($result) {
                header('Location: /admin/activities');
            }
        }
    }
}