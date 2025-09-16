<?php

namespace Controllers;

use Classes\Pagination;
use Model\Article;
use MVC\Router;
use Intervention\Image\ImageManagerStatic as Image;

class ArticlesController {

  public static function index(Router $router) {

    $actual_page = $_GET['page'];
    $actual_page = filter_var($actual_page, FILTER_VALIDATE_INT);

    if (!$actual_page || $actual_page < 1) {
      header('Location: /admin/articles?page=1');
    }

    $records_per_page = 6;
    $total_records = article::total();
    $pagination = new Pagination($actual_page, $records_per_page, $total_records);

    $articles = Article::paginate($records_per_page, $pagination->offset());

    if($pagination->total_pages() < $actual_page) {
      header('Location: /admin/articles?page=1');
    }

    if(!is_admin()) {
      header('Location: /login');
    }

    $router->render('admin/articles/index', [
      'title' => 'Artículos',
      'articles' => $articles,
      // 'pagination' => $pagination->pagination()
    ]);
  }

  public static function create(Router $router) {
    if(!is_admin()) {
      header('Location: /login');
    }
    $alerts = [];
    $article = new article;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $article->synchronize($_POST);

      $alerts = $article->validate();

      // Guardar el registro
      if (empty($alerts)) {
        // Guardar en la DB
        $result = $article->save();
        // debuguear($result);
        if ($result) {
          header('Location: /admin/articles');
        }
      }
    }

    $router->render('admin/articles/create', [
      'title' => 'Registrar article',
      'alerts' => $alerts,
      'article' => $article,
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
      header('Location: /admin/articles');
    }

    // Obtener article a editar
    $article = Article::find($id);

    if(!$article) {
      header('Location: /admin/articles');
    }


    if($_SERVER['REQUEST_METHOD'] === 'POST' ) {
      if(!is_admin()) {
        header('Location: /login');
      }

      $article->synchronize($_POST);
      
      $alerts = $article->validate();

      if(empty($alerts)) {
        $result = $article->save();

        if($result) {
          header('Location: /admin/articles');
        }
      }
    }

    $router->render('admin/articles/edit', [
      'title' => 'Editar artículo',
      'alerts' => $alerts,
      'article' => $article,
    ]);
  }

  public static function delete() {
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
      if(!is_admin()) {
        header('Location: /login');
      }
      $id = $_POST['id'];

      $article = Article::find($id);

      if(!isset($article)) {
        header('Location: /admin/articles');
      }

      $result = $article->eliminar();

      if($result) {
        header('Location: /admin/articles');
      }
    }
  }
}
