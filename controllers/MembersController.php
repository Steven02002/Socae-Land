<?php

namespace Controllers;

use Classes\Pagination;
use Model\Member;
use Model\Area;
use MVC\Router;
use Intervention\Image\ImageManagerStatic as Image;

class MembersController {

  public static function index(Router $router) {

    $actual_page = $_GET['page'];
    $actual_page = filter_var($actual_page, FILTER_VALIDATE_INT);

    if (!$actual_page || $actual_page < 1) {
      header('Location: /admin/members?page=1');
    }

    $records_per_page = 6;
    $total_records = Member::total();
    $pagination = new Pagination($actual_page, $records_per_page, $total_records);

    $members = Member::paginate($records_per_page, $pagination->offset());

    if($pagination->total_pages() < $actual_page) {
      header('Location: /admin/members?page=1');
    }

    if(!is_admin()) {
      header('Location: /login');
    }

    foreach ($members as $member) {
      $member->area = Area::find($member->area_id);
    }

    $router->render('admin/members/index', [
      'title' => 'Miembros',
      'members' => $members,
      'pagination' => $pagination->pagination()
    ]);
  }

  public static function create(Router $router) {
    if(!is_admin()) {
      header('Location: /login');
    }
    $alerts = [];
    $member = new Member;

    $areas = Area::all();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // Leer imagen
      if (!empty($_FILES['image']['tmp_name'])) {
        $folder_images = '../public/img/members';

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

      $_POST['social_medias'] = json_encode($_POST['social_medias'], JSON_UNESCAPED_SLASHES);

      $member->synchronize($_POST);

      $alerts = $member->validate();

      // Guardar el registro
      if (empty($alerts)) {
        // Guardar imagenes
        $image_png->save($folder_images . '/' . $image_name . '.png');
        $image_webp->save($folder_images . '/' . $image_name . '.webp');

        // Guardar en la DB
        $result = $member->save();
        // debuguear($result);

        if ($result) {
          header('Location: /admin/members');
        }
      }
    }

    $router->render('admin/members/create', [
      'title' => 'Registrar miembro',
      'alerts' => $alerts,
      'member' => $member,
      'areas' => $areas,
      'social_medias' => json_decode($member->social_medias)
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
      header('Location: /admin/members');
    }

    $areas = Area::all();

    // Obtener miembro a editar
    $member = Member::find($id);

    if(!$member) {
      header('Location: /admin/members');
    }

    $member->current_image = $member->image;

    if($_SERVER['REQUEST_METHOD'] === 'POST' ) {
      if(!is_admin()) {
        header('Location: /login');
      }
      if (!empty($_FILES['image']['tmp_name'])) {
        $folder_images = '../public/img/members';

        // Crear la carpeta si no existe
        if (!is_dir($folder_images)) {
          mkdir($folder_images, 0755, true);
        }

        $oldPngImage = $folder_images . '/' . $member->current_image . '.png';
        $oldWebpImage = $folder_images . '/' . $member->current_image . '.webp';
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
        $_POST['image'] = $member->current_image;
      }

      $_POST['social_medias'] = json_encode($_POST['social_medias'], JSON_UNESCAPED_SLASHES);

      $member->synchronize($_POST);
      
      $alerts = $member->validate();

      if(empty($alerts)) {
        if(isset($image_name)) {
          $image_png->save($folder_images . '/' . $image_name . '.png');
          $image_webp->save($folder_images . '/' . $image_name . '.webp');
        }

        $result = $member->save();

        if($result) {
          header('Location: /admin/members');
        }
      }
    }

    $router->render('admin/members/edit', [
      'title' => 'Editar miembro',
      'alerts' => $alerts,
      'member' => $member,
      'areas' => $areas,
      'social_medias' => json_decode($member->social_medias)
    ]);
  }

  public static function delete() {
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
      if(!is_admin()) {
        header('Location: /login');
      }
      $id = $_POST['id'];

      $member = Member::find($id);

      if(!isset($member)) {
        header('Location: /admin/members');
      }

      // Primero, eliminar las imágenes asociadas
      $folder_images = '../public/img/members';
      $pngImage = $folder_images . '/' . $member->image . '.png';
      $webpImage = $folder_images . '/' . $member->image . '.webp';
      if (file_exists($pngImage)) {
        unlink($pngImage);
      }
      if (file_exists($webpImage)) {
        unlink($webpImage);
      }

      $result = $member->eliminar();

      if($result) {
        header('Location: /admin/members');
      }
    }
  }
}
