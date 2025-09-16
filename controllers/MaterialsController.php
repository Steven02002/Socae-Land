<?php

namespace Controllers;

use Classes\Pagination;
use Model\Material;
use MVC\Router;
use Intervention\Image\ImageManagerStatic as Image;

class MaterialsController {

  public static function index(Router $router) {

    $actual_page = $_GET['page'];
    $actual_page = filter_var($actual_page, FILTER_VALIDATE_INT);

    if (!$actual_page || $actual_page < 1) {
      header('Location: /admin/materials?page=1');
    }

    $records_per_page = 6;
    $total_records = Material::total();
    $pagination = new Pagination($actual_page, $records_per_page, $total_records);

    $materials = Material::paginate($records_per_page, $pagination->offset());

    if($pagination->total_pages() < $actual_page) {
      header('Location: /admin/materials?page=1');
    }

    if(!is_admin()) {
      header('Location: /login');
    }

    $router->render('admin/materials/index', [
      'title' => 'Materiales',
      'materials' => $materials,
      // 'pagination' => $pagination->pagination()
    ]);
  }

  public static function create(Router $router) {
    if(!is_admin()) {
      header('Location: /login');
    }
    $alerts = [];
    $material = new Material;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      if (!empty($_FILES['image']['tmp_name'])) {
        $folder_images = '../public/img/materials';

        // Crear la carpeta si no existe
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

      $material->synchronize($_POST);

      $alerts = $material->validate();

      // Guardar el registro
      if (empty($alerts)) {
        // Guardar imagenes
        $image_png->save($folder_images . '/' . $image_name . '.png');
        $image_webp->save($folder_images . '/' . $image_name . '.webp');

        // Guardar en la DB
        $result = $material->save();
        // debuguear($result);

        if ($result) {
          header('Location: /admin/materials');
        }
      }
    }

    $router->render('admin/materials/create', [
      'title' => 'Registrar material',
      'alerts' => $alerts,
      'material' => $material,
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
      header('Location: /admin/materials');
    }

    // Obtener material a editar
    $material = Material::find($id);

    if(!$material) {
      header('Location: /admin/materials');
    }

    $material->current_image = $material->image;

    if($_SERVER['REQUEST_METHOD'] === 'POST' ) {
      if(!is_admin()) {
        header('Location: /login');
      }
      if (!empty($_FILES['image']['tmp_name'])) {
        $folder_images = '../public/img/materials';

        // Crear la carpeta si no existe
        if (!is_dir($folder_images)) {
          mkdir($folder_images, 0755, true);
        }

        // Antes de guardar la nueva imagen, eliminar la anterior
        $oldPngImage = $folder_images . '/' . $material->current_image . '.png';
        $oldWebpImage = $folder_images . '/' . $material->current_image . '.webp';
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
        $_POST['image'] = $material->current_image;
      }

      $material->synchronize($_POST);
      
      $alerts = $material->validate();

      if(empty($alerts)) {
        if(isset($image_name)) {
          $image_png->save($folder_images . '/' . $image_name . '.png');
          $image_webp->save($folder_images . '/' . $image_name . '.webp');
        }

        $result = $material->save();

        if($result) {
          header('Location: /admin/materials');
        }
      }
    }

    $router->render('admin/materials/edit', [
      'title' => 'Editar miembro',
      'alerts' => $alerts,
      'material' => $material,
    ]);
  }

  public static function delete() {
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
      if(!is_admin()) {
        header('Location: /login');
      }
      $id = $_POST['id'];
  
      $material = Material::find($id);
  
      if(!isset($material)) {
        header('Location: /admin/materials');
      }
  
      // Primero, eliminar las imágenes asociadas
      $folder_images = '../public/img/materials';
      $pngImage = $folder_images . '/' . $material->image . '.png';
      $webpImage = $folder_images . '/' . $material->image . '.webp';
      if (file_exists($pngImage)) {
        unlink($pngImage);
      }
      if (file_exists($webpImage)) {
        unlink($webpImage);
      }
  
      // Después, eliminar el registro de la base de datos
      $result = $material->eliminar();
  
      if($result) {
        header('Location: /admin/materials');
      }
    }
  }
}
