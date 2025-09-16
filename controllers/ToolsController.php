<?php

namespace Controllers;

use Classes\Pagination;
use Model\Tools;
use MVC\Router;
use Intervention\Image\ImageManagerStatic as Image;

class ToolsController
{
    public static function index(Router $router)
    {

        $actual_page = $_GET['page'];
        $actual_page = filter_var($actual_page, FILTER_VALIDATE_INT);

        if (!$actual_page || $actual_page < 1) {
            header('Location: /admin/tools?page=1');
        }

        $records_per_page = 6;
        $total_records = Tools::total();
        $pagination = new Pagination($actual_page, $records_per_page, $total_records);

        $tools = Tools::paginate($records_per_page, $pagination->offset());

        if ($pagination->total_pages() < $actual_page) {
            header('Location: /admin/tools?page=1');
        }

        if (!is_admin()) {
            header('Location: /login');
        }

        //debuguear($tools);
        
        $router->render('admin/tools/index', [
            'title' => 'Herramientas',
            'tools' => $tools,
            'pagination' => $pagination->pagination()
        ]);
    }

    public static function create(Router $router)
    {
        if (!is_admin()) {
            header('Location: /login');
        }
        $alerts = [];

        //debuguear($newsCategory);
        $tool = new Tools;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Leer imagen
            if (!empty($_FILES['image']['tmp_name'])) {
                $folder_images = '../public/img/tools';

                // Crear la carpeta si no existe
                if (!is_dir($folder_images)) {
                    mkdir($folder_images, 0755, true);
                }

                $image_png = Image::make($_FILES['image']['tmp_name'])->fit(800, 800)->encode('png', 80);
                $image_webp = Image::make($_FILES['image']['tmp_name'])->fit(800, 800)->encode('webp', 80);

                $image_name = md5(uniqid(rand(), true));

                $_POST['image'] = $image_name;
            }

            $tool->synchronize($_POST);

            $alerts = $tool->validate();

            // Guardar el registro
            if (empty($alerts)) {
                // Guardar imagenes
                $image_png->save($folder_images . '/' . $image_name . '.png');
                $image_webp->save($folder_images . '/' . $image_name . '.webp');

                // Guardar en la DB
                $result = $tool->save();
                //debuguear($result);

                if ($result) {
                    header('Location: /admin/tools');
                }
            }
        }

        $router->render('admin/tools/create', [
            'title' => 'Publicar Herramienta',
            'alerts' => $alerts,
            'tool' => $tool,
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
            header('Location: /admin/tools');
        }
        // Obtener expositor a editar
        $tool = Tools::find($id);

        //debuguear($speaker);

        if (!$tool) {
            header('Location: /admin/tools');
        }

        $tool->current_image = $tool->image;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!is_admin()) {
                header('Location: /login');
            }
            if (!empty($_FILES['image']['tmp_name'])) {
                $folder_images = '../public/img/tools';

                // Crear la carpeta si no existe
                if (!is_dir($folder_images)) {
                    mkdir($folder_images, 0755, true);
                }

                $oldPngImage = $folder_images . '/' . $tool->current_image . '.png';
                $oldWebpImage = $folder_images . '/' . $tool->current_image . '.webp';
                if (file_exists($oldPngImage)) {
                    unlink($oldPngImage);
                }
                if (file_exists($oldWebpImage)) {
                    unlink($oldWebpImage);
                }

                $image_png = Image::make($_FILES['image']['tmp_name'])->fit(800, 800)->encode('png', 80);
                $image_webp = Image::make($_FILES['image']['tmp_name'])->fit(800, 800)->encode('webp', 80);

                $image_name = md5(uniqid(rand(), true));

                $_POST['image'] = $image_name;
            } else {
                $_POST['image'] = $new->current_image;
            }

            $_POST['social_medias'] = json_encode($_POST['social_medias'], JSON_UNESCAPED_SLASHES);

            $tool->synchronize($_POST);

            $alerts = $tool->validate();

            if (empty($alerts)) {
                if (isset($image_name)) {
                    $image_png->save($folder_images . '/' . $image_name . '.png');
                    $image_webp->save($folder_images . '/' . $image_name . '.webp');
                }

                $result = $tool->save();

                if ($result) {
                    header('Location: /admin/tools');
                }
            }
        }

        $router->render('admin/tools/edit', [
            'title' => 'Editar expositor',
            'alerts' => $alerts,
            'tool' => $tool,
        ]);
    }

    public static function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!is_admin()) {
                header('Location: /login');
            }
            $id = $_POST['id'];

            $tool = Tools::find($id);

            if (!isset($tool)) {
                header('Location: /admin/tools');
            }

            $folder_images = '../public/img/tools';
            $pngImage = $folder_images . '/' . $tool->image . '.png';
            $webpImage = $folder_images . '/' . $tool->image . '.webp';
            if (file_exists($pngImage)) {
              unlink($pngImage);
            }
            if (file_exists($webpImage)) {
              unlink($webpImage);
            }

            $result = $tool->eliminar();

            if ($result) {
                header('Location: /admin/tools');
            }
        }
    }
}