<?php

namespace Controllers;

use MVC\Router;
use Model\Content;
use Intervention\Image\ImageManagerStatic as Image;


class HomeController
{
    public static function index(Router $router) {
        if (!is_admin()) {
            header('Location: /login');
        }

        $router->render('admin/home/index', [
            'title' => 'Home',
        ]);
    }

    public static function editDescription(Router $router)
    {
        if(!is_admin()) {
            header('Location: /login');
          }
        $alerts = [];
        // Validar id
        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);
        
        if(!$id) {
            header('Location: /admin/home');
        }

        $content = Content::find($id);

        //debuguear($content);
        
        if(!$content) {
            header('Location: /admin/home'); //ver el home eh
        }

        $content->current_image = $content->image1;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!is_admin()) {
                header('Location: /login');
            }
            if (!empty($_FILES['image1']['tmp_name'])) {
                $folder_images = '../public/img/content';
                // Crear la carpeta si no existe
                if (!is_dir($folder_images)) {
                    mkdir($folder_images, 0755, true);
                }

                $oldPngImage = $folder_images . '/' . $content->current_image . '.png';
                $oldWebpImage = $folder_images . '/' . $content->current_image . '.webp';
                if (file_exists($oldPngImage)) {
                    unlink($oldPngImage);
                }
                if (file_exists($oldWebpImage)) {
                    unlink($oldWebpImage);
                }

                $image_png = Image::make($_FILES['image1']['tmp_name'])->fit(800, 800)->encode('png', 80);
                $image_webp = Image::make($_FILES['image1']['tmp_name'])->fit(800, 800)->encode('webp', 80);

                //debuguear($image_png);

                $image_name = md5(uniqid(rand(), true));

                $_POST['image1'] = $image_name;
            } else {
                $_POST['image1'] = $content->current_image;
            }

            $content->synchronize($_POST);

            $alerts = $content->validate();

            if (empty($alerts)) {
                if (isset($image_name)) {
                    $image_png->save($folder_images . '/' . $image_name . '.png');
                    $image_webp->save($folder_images . '/' . $image_name . '.webp');
                }

                
                $result = $content->save();
                
                if ($result) {
                    header('Location: /admin/home');
                }
            }
        }

        $router->render('admin/home/edit_description', [
            'title' => 'Editar Descripción',
            'alerts' => $alerts,
            'content' => $content
        ]);
    }

    public static function editAboutUs(Router $router)
    {
        if(!is_admin()) {
            header('Location: /login');
          }
        $alerts = [];
        // Validar id
        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);
        
        if(!$id) {
            header('Location: /admin/home');
        }

        $content = Content::find($id);

        //debuguear($content);
        
        if(!$content) {
            header('Location: /admin/home'); //ver el home eh
        }

        $content->current_image = $content->image1;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!is_admin()) {
                header('Location: /login');
            }
            if (!empty($_FILES['image1']['tmp_name'])) {
                $folder_images = '../public/img/content';
                // Crear la carpeta si no existe
                if (!is_dir($folder_images)) {
                    mkdir($folder_images, 0755, true);
                }

                $oldPngImage = $folder_images . '/' . $content->current_image . '.png';
                $oldWebpImage = $folder_images . '/' . $content->current_image . '.webp';
                if (file_exists($oldPngImage)) {
                    unlink($oldPngImage);
                }
                if (file_exists($oldWebpImage)) {
                    unlink($oldWebpImage);
                }

                $image_png = Image::make($_FILES['image1']['tmp_name'])->fit(800, 800)->encode('png', 80);
                $image_webp = Image::make($_FILES['image1']['tmp_name'])->fit(800, 800)->encode('webp', 80);

                //debuguear($image_png);

                $image_name = md5(uniqid(rand(), true));

                $_POST['image1'] = $image_name;
            } else {
                $_POST['image1'] = $content->current_image;
            }

            $content->synchronize($_POST);

            $alerts = $content->validate();

            if (empty($alerts)) {
                if (isset($image_name)) {
                    $image_png->save($folder_images . '/' . $image_name . '.png');
                    $image_webp->save($folder_images . '/' . $image_name . '.webp');
                }

                
                $result = $content->save();
                
                if ($result) {
                    header('Location: /admin/home');
                }
            }
        }

        $router->render('admin/home/edit_about_us', [
            'title' => 'Editar Acerca de Nosotros',
            'alerts' => $alerts,
            'content' => $content
        ]);
    }
}