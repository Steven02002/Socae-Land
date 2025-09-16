<?php

namespace Controllers;

use Model\Category;
use Model\News;
use Classes\Pagination;
use Model\NewsCategory;
use MVC\Router;
use Intervention\Image\ImageManagerStatic as Image;

class NewsController
{

    public static function index(Router $router)
    {
        $actual_page = $_GET['page'];
        $actual_page = filter_var($actual_page, FILTER_VALIDATE_INT);

        if (!$actual_page || $actual_page < 1) {
            header('Location: /admin/news?page=1');
        }

        $records_per_page = 6;
        $total_records = News::total();
        $pagination = new Pagination($actual_page, $records_per_page, $total_records);

        $news = News::paginate($records_per_page, $pagination->offset());

        if ($pagination->total_pages() < $actual_page) {
            header('Location: /admin/News?page=1');
        }

        if (!is_admin()) {
            header('Location: /login');
        }

        foreach ($news as $new) {
            $new->category = NewsCategory::find($new->category_id);
        }
        //debuguear($new);
        $router->render('admin/news/index', [
            'title' => 'Noticias',
            'news' => $news,
            'pagination' => $pagination->pagination()
        ]);
    }

    public static function create(Router $router)
    {
        if (!is_admin()) {
            header('Location: /login');
        }
        $alerts = [];
        $newsCategory = NewsCategory::all();
        //debuguear($newsCategory);
        $new = new News;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Leer imagen
            if (!empty($_FILES['image']['tmp_name'])) {
                $folder_images = '../public/img/news';

                // Crear la carpeta si no existe
                if (!is_dir($folder_images)) {
                    mkdir($folder_images, 0755, true);
                }

                $image_png = Image::make($_FILES['image']['tmp_name'])->fit(950, 950)->encode('png', 80);
                $image_webp = Image::make($_FILES['image']['tmp_name'])->fit(950, 950)->encode('webp', 80);

                $image_name = md5(uniqid(rand(), true));

                $_POST['image'] = $image_name;
            }

            $new->synchronize($_POST);

            $alerts = $new->validate();

            // Guardar el registro
            if (empty($alerts)) {
                // Guardar imagenes
                $image_png->save($folder_images . '/' . $image_name . '.png');
                $image_webp->save($folder_images . '/' . $image_name . '.webp');

                // Guardar en la DB
                $result = $new->save();
                 //debuguear($result);

                if ($result) {
                    header('Location: /admin/news');
                }
            }
        }

        $router->render('admin/news/create', [
            'title' => 'Crear Noticia',
            'alerts' => $alerts,
            'new' => $new,
            'newsCategory' => $newsCategory
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

        $newsCategory = NewsCategory::all();
        // Obtener expositor a editar
        $new = News::find($id);

        //debuguear($speaker);

        if (!$new) {
            header('Location: /admin/news');
        }

        $new->current_image = $new->image;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!is_admin()) {
                header('Location: /login');
            }
            if (!empty($_FILES['image']['tmp_name'])) {
                $folder_images = '../public/img/news';

                // Crear la carpeta si no existe
                if (!is_dir($folder_images)) {
                    mkdir($folder_images, 0755, true);
                }

                $oldPngImage = $folder_images . '/' . $new->current_image . '.png';
                $oldWebpImage = $folder_images . '/' . $new->current_image . '.webp';
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

            $new->synchronize($_POST);

            $alerts = $new->validate();

            if (empty($alerts)) {
                if (isset($image_name)) {
                    $image_png->save($folder_images . '/' . $image_name . '.png');
                    $image_webp->save($folder_images . '/' . $image_name . '.webp');
                }

                $result = $new->save();

                if ($result) {
                    header('Location: /admin/news');
                }
            }
        }

        $router->render('admin/news/edit', [
            'title' => 'Editar expositor',
            'alerts' => $alerts,
            'new' => $new,
            'newsCategory' => $newsCategory
        ]);
    }

    public static function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!is_admin()) {
                header('Location: /login');
            }
            $id = $_POST['id'];

            $new = News::find($id);

            if (!isset($new)) {
                header('Location: /admin/news');
            }

            // Primero, eliminar las imágenes asociadas
            $folder_images = '../public/img/news';
            $pngImage = $folder_images . '/' . $new->image . '.png';
            $webpImage = $folder_images . '/' . $new->image . '.webp';
            if (file_exists($pngImage)) {
              unlink($pngImage);
            }
            if (file_exists($webpImage)) {
              unlink($webpImage);
            }

            $result = $new->eliminar();

            if ($result) {
                header('Location: /admin/news');
            }
        }
    }
}