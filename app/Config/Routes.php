<?php

$routes->get('login', 'AuthController::showLoginForm');
$routes->post('login', 'AuthController::authenticate');
$routes->get('register', 'AuthController::register');
$routes->post('register', 'AuthController::createUser');
$routes->get('logout', 'AuthController::logout');
$routes->get('blog/viewpost/(:num)', 'BlogController::view/$1');
$routes->get('blog/filterByCategory', 'BlogController::filterByCategory');
$routes->get('bem-vindo', 'AuthController::BemVindo');
$routes->get('parceiros', 'ParceirosController::index');
$routes->post('addComment', 'CommentController::addComment');
$routes->add('editComment', 'CommentController::editComment', ['as' => 'editComment']);
$routes->post('blog/viewpost/(:num)', 'BlogController::view/$1');
$routes->add('deleteComment/(:num)', 'CommentController::deleteComment/$1');
$routes->get('esqueceusenha', 'AuthController::showForgotPasswordForm');
$routes->post('updateComment', 'CommentController::updateComment');

$routes->get('editComment/(:num)', 'CommentController::editComment/$1');


// Rota para o painel do administrador
$routes->get('dashboard', 'AdminController::dashboard');
$routes->get('/', 'HomeController::index'); // Rota da página inicial

// Rotas do blog
$routes->get('blog', 'BlogController::index');
$routes->get('createpost', 'BlogController::showCreatePostForm');
$routes->post('createpost', 'BlogController::createPost');
$routes->get('viewpost2', 'BlogController::view'); // Rota para a visualização de postagens

// Rota para definir o idioma
$routes->get('idioma/(:any)', 'LanguageController::definirIdioma/$1');

// Rota para visualizar comentários
$routes->get('comment/viewComments/(:num)', 'CommentController::viewComments/$1');

// Rota para a página de usuários
$routes->get('usuarios', 'Usuarios::index', ['as' => 'login']);
$routes->get('usuarios/adicionar', 'Usuarios::adicionar');
$routes->post('usuarios/add', 'Usuarios::add');
$routes->post('usuarios/login', 'Usuarios::login');

// Rota para o localizador de pet shops
$routes->get('localizador_petshops', 'PetShopController::localizador');
$routes->post('deleteComment/(:num)', 'CommentController::deleteComment/$1', ['as' => 'deleteComment']);

$routes->get('viewpost/(:num)', 'BlogController::view/$1');
$routes->post('deleteComment/(:num)', 'CommentController::deleteComment/$1');
// TESTE