<?php
require_once __DIR__ . '/../includes/app.php';

use Controllers\ActivitiesController;
use Controllers\APIEvents;
use Controllers\APISpeakers;
// use Controllers\DashboardController;
use Controllers\EventosController;
use Controllers\NewsController;
use Controllers\PagesController;
use Controllers\SpeakersController;
use Controllers\MembersController;
use Controllers\MaterialsController;
use Controllers\ArticlesController;
use Controllers\RegistradosController;
use Controllers\HomeController;
use Controllers\ToolsController;
use MVC\Router;
use Controllers\AuthController;

$router = new Router();


// Login
$router->get('/login', [AuthController::class, 'login']);
$router->post('/login', [AuthController::class, 'login']);
$router->post('/logout', [AuthController::class, 'logout']);

// create Cuenta
$router->get('/register', [AuthController::class, 'register']);
$router->post('/register', [AuthController::class, 'register']);

// Formulario de olvide mi password
$router->get('/forget', [AuthController::class, 'forget']);
$router->post('/forget', [AuthController::class, 'forget']);

// Colocar el nuevo password
$router->get('/restore', [AuthController::class, 'restore']);
$router->post('/restore', [AuthController::class, 'restore']);

// Confirmación de Cuenta
$router->get('/message', [AuthController::class, 'message']);
$router->get('/confirm-account', [AuthController::class, 'confirmar']);

//Area de administracion
// $router->get('/admin/dashboard', [DashboardController::class, 'index']);

// Speakers
$router->get('/admin/speakers', [SpeakersController::class, 'index']);
$router->get('/admin/speakers/create', [SpeakersController::class, 'create']);
$router->post('/admin/speakers/create', [SpeakersController::class, 'create']);
$router->get('/admin/speakers/edit', [SpeakersController::class, 'edit']);
$router->post('/admin/speakers/edit', [SpeakersController::class, 'edit']);
$router->post('/admin/speakers/delete', [SpeakersController::class, 'delete']);

// Members
$router->get('/admin/members', [MembersController::class, 'index']);
$router->get('/admin/members/create', [MembersController::class, 'create']);
$router->post('/admin/members/create', [MembersController::class, 'create']);
$router->get('/admin/members/edit', [MembersController::class, 'edit']);
$router->post('/admin/members/edit', [MembersController::class, 'edit']);
$router->post('/admin/members/delete', [MembersController::class, 'delete']);

// Materials
$router->get('/admin/materials', [MaterialsController::class, 'index']);
$router->get('/admin/materials/create', [MaterialsController::class, 'create']);
$router->post('/admin/materials/create', [MaterialsController::class, 'create']);
$router->get('/admin/materials/edit', [MaterialsController::class, 'edit']);
$router->post('/admin/materials/edit', [MaterialsController::class, 'edit']);
$router->post('/admin/materials/delete', [MaterialsController::class, 'delete']);

// Articles
$router->get('/admin/articles', [ArticlesController::class, 'index']);
$router->get('/admin/articles/create', [ArticlesController::class, 'create']);
$router->post('/admin/articles/create', [ArticlesController::class, 'create']);
$router->get('/admin/articles/edit', [ArticlesController::class, 'edit']);
$router->post('/admin/articles/edit', [ArticlesController::class, 'edit']);
$router->post('/admin/articles/delete', [ArticlesController::class, 'delete']);

$router->get('/admin/eventos', [EventosController::class, 'index']);
$router->get('/admin/eventos/create', [EventosController::class, 'create']);
$router->post('/admin/eventos/create', [EventosController::class, 'create']);
$router->get('/admin/eventos/edit', [EventosController::class, 'edit']);
$router->post('/admin/eventos/edit', [EventosController::class, 'edit']);
$router->post('/admin/eventos/delete', [EventosController::class, 'delete']);


$router->get('/api/speakers', [APISpeakers::class, 'index']);
$router->get('/api/speaker', [APISpeakers::class, 'speaker']);


$router->get('/admin/registrados', [RegistradosController::class, 'index']);

// pagina de Home
$router->get('/admin/home', [HomeController::class, 'index']);
$router->get('/admin/home/edit_description', [HomeController::class, 'editDescription']);
$router->post('/admin/home/edit_description', [HomeController::class, 'editDescription']);
$router->get('/admin/home/edit_about_us', [HomeController::class, 'editAboutUs']);
$router->post('/admin/home/edit_about_us', [HomeController::class, 'editAboutUs']);

// pagina de News ADMIN
$router->get('/admin/news', [NewsController::class, 'index']);
$router->get('/admin/news/create', [NewsController::class, 'create']);
$router->post('/admin/news/create', [NewsController::class, 'create']);
$router->get('/admin/news/edit', [NewsController::class, 'edit']);
$router->post('/admin/news/edit', [NewsController::class, 'edit']);
$router->post('/admin/news/delete', [NewsController::class, 'delete']);

//Pagina de Fotos Actividades ADMIN
$router->get('/admin/activities', [ActivitiesController::class, 'index']);
$router->get('/admin/activities/create', [ActivitiesController::class, 'create']);
$router->post('/admin/activities/create', [ActivitiesController::class, 'create']);
$router->get('/admin/activities/edit', [ActivitiesController::class, 'edit']);
$router->post('/admin/activities/edit', [ActivitiesController::class, 'edit']);
$router->post('/admin/activities/delete', [ActivitiesController::class, 'delete']);

//Pagina de Fotos herramientas ADMIN
$router->get('/admin/tools', [ToolsController::class, 'index']);
$router->get('/admin/tools/create', [ToolsController::class, 'create']);
$router->post('/admin/tools/create', [ToolsController::class, 'create']);
$router->get('/admin/tools/edit', [ToolsController::class, 'edit']);
$router->post('/admin/tools/edit', [ToolsController::class, 'edit']);
$router->post('/admin/tools/delete', [ToolsController::class, 'delete']);

// area publica
$router->get('/', [PagesController::class, 'index']); // <-- AÑADE ESTA LÍNEA
$router->get('/home', [PagesController::class, 'index']);
$router->get('/people-development', [PagesController::class, 'peopleDevelopment']); 
$router->get('/marketing', [PagesController::class, 'marketing']);
$router->get('/innovation', [PagesController::class, 'innovation']);
$router->get('/investigation-Cientific', [PagesController::class, 'investigationCientific']);
$router->get('/404', [PagesController::class, 'error']);

$router->comprobarRutas();
