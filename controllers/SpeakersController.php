<?php

namespace Controllers;

use Classes\Pagination;
use Model\Speaker;
use MVC\Router;
use Intervention\Image\ImageManagerStatic as Image;

class SpeakersController {

  public static function index(Router $router) {

    $actual_page = $_GET['page'];
    $actual_page = filter_var($actual_page, FILTER_VALIDATE_INT);

    if (!$actual_page || $actual_page < 1) {
      header('Location: /admin/speakers?page=1');
    }

    $records_per_page = 6;
    $total_records = Speaker::total();
    $pagination = new Pagination($actual_page, $records_per_page, $total_records);

    $speakers = Speaker::paginate($records_per_page, $pagination->offset());

    if($pagination->total_pages() < $actual_page) {
      header('Location: /admin/speakers?page=1');
    }

    if(!is_admin()) {
      header('Location: /login');
    }

    $router->render('admin/speakers/index', [
      'title' => 'Expositores',
      'speakers' => $speakers,
      'pagination' => $pagination->pagination()
    ]);
  }

  public static function create(Router $router) {
    if(!is_admin()) {
      header('Location: /login');
    }
    $alerts = [];
    $speaker = new Speaker;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // Leer imagen
      if (!empty($_FILES['image']['tmp_name'])) {
        $folder_images = '../public/img/speakers';
        
        if (!is_dir($folder_images)) {
          mkdir($folder_images, 0755, true);
        }

        $image_png = Image::make($_FILES['image']['tmp_name'])->fit(800, 800)->encode('png', 80);
        $image_webp = Image::make($_FILES['image']['tmp_name'])->fit(800, 800)->encode('webp', 80);

        $image_name = md5(uniqid(rand(), true));

        $_POST['image'] = $image_name;
      }
      // else {
      //   debuguear('No hay imagen');
      // }

      $_POST['social_medias'] = json_encode($_POST['social_medias'], JSON_UNESCAPED_SLASHES);

      $speaker->synchronize($_POST);

      $alerts = $speaker->validate();

      // Guardar el registro
      if (empty($alerts)) {
        // Guardar imagenes
        $image_png->save($folder_images . '/' . $image_name . '.png');
        $image_webp->save($folder_images . '/' . $image_name . '.webp');

        // Guardar en la DB
        $result = $speaker->save();
        // debuguear($result);

        if ($result) {
          header('Location: /admin/speakers');
        }
      }
    }

    $router->render('admin/speakers/create', [
      'title' => 'Registrar expositor',
      'alerts' => $alerts,
      'speaker' => $speaker,
      'social_medias' => json_decode($speaker->social_medias)
    ]);
  }

  public static function edit(Router $router) {
    if(!is_admin()) {
      header('Location: /login');
    }
    $alerts = [];
    // Validar id
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id) {
      header('Location: /admin/speakers');
    }

    // Obtener expositor a editar
    $speaker = Speaker::find($id);

    //debuguear($speaker);

    if(!$speaker) {
      header('Location: /admin/speakers');
    }

    $speaker->current_image = $speaker->image;

    if($_SERVER['REQUEST_METHOD'] === 'POST' ) {
      if(!is_admin()) {
        header('Location: /login');
      }
      if (!empty($_FILES['image']['tmp_name'])) {
        $folder_images = '../public/img/speakers';

        // Crear la carpeta si no existe
        if (!is_dir($folder_images)) {
          mkdir($folder_images, 0755, true);
        }

        $oldPngImage = $folder_images . '/' . $speaker->current_image . '.png';
        $oldWebpImage = $folder_images . '/' . $speaker->current_image . '.webp';
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
        $_POST['image'] = $speaker->current_image;
      }

      $_POST['social_medias'] = json_encode($_POST['social_medias'], JSON_UNESCAPED_SLASHES);

      $speaker->synchronize($_POST);

      $alerts = $speaker->validate();

      if(empty($alerts)) {
        if(isset($image_name)) {
          $image_png->save($folder_images . '/' . $image_name . '.png');
          $image_webp->save($folder_images . '/' . $image_name . '.webp');
        }

        $result = $speaker->save();

        if($result) {
          header('Location: /admin/speakers');
        }
      }
    }

    $router->render('admin/speakers/edit', [
      'title' => 'Editar expositor',
      'alerts' => $alerts,
      'speaker' => $speaker,
      'social_medias' => json_decode($speaker->social_medias)
    ]);
  }

  public static function delete() {
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
      if(!is_admin()) {
        header('Location: /login');
      }
      $id = $_POST['id'];

      $speaker = Speaker::find($id);

      if(!isset($speaker)) {
        header('Location: /admin/speakers');
      }

      $result = $speaker->eliminar();

      $folder_images = '../public/img/speakers';
      $pngImage = $folder_images . '/' . $speaker->image . '.png';
      $webpImage = $folder_images . '/' . $speaker->image . '.webp';
      if (file_exists($pngImage)) {
        unlink($pngImage);
      }
      if (file_exists($webpImage)) {
        unlink($webpImage);
      }

      if (!$result) {
        echo "
        <script src=\"https://cdn.jsdelivr.net/npm/sweetalert2@11\"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'No se puede eliminar el expositor porque está siendo usado en algún evento!',
                    confirmButtonColor: '#840c44'
                }).then(function() {
                    setTimeout(function() {
                        window.location.href = '/admin/speakers';
                    }, 100); // Retrasa la redirección por 2 segundos (ajusta según tus necesidades)
                });
            });
        </script>
        ";
    } else {
        header('Location: /admin/speakers');
    }
    }
  }
}
