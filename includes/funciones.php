<?php

function debuguear($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

function pagina_actual($path) : bool {
    return str_contains( $_SERVER['PATH_INFO'] ?? '/', $path) ? true : false;
}

function is_auth() : bool {
  if(!isset($_SESSION)) {
    session_start();
  }
  return isset($_SESSION['first_name']) && !empty($_SESSION);
}

function is_admin() : bool {
  if(!isset($_SESSION)) {
    session_start();
  }
  return isset($_SESSION['admin']) && !empty($_SESSION['admin']);
}

function aos_animation() : void {
  $efects = ['fade-up', 'fade-down', 'fade-left', 'fede-right', 'flip-left', 'flip-right', 'zoom-in', 'zoom-in-up', 'zoom-in-down', 'zoom-out'];

  $efect = array_rand($efects, 1);
  echo ' data-aos="' . $efects[$efect] . '" ';
}