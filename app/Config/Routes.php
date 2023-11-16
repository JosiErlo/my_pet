<?php

// Configuração de rotas no CodeIgniter

$routes->get('login', 'AuthController::showLoginForm');
$routes->post('login', 'AuthController::authenticate');
$routes->get('register', 'AuthController::showRegistrationForm');
$routes->post('register', 'AuthController::createUser');
$routes->get('logout', 'AuthController::logout');

$routes->get('blog/filterByCategory', 'BlogController::filterByCategory');
$routes->get('bem-vindo', 'AuthController::BemVindo');
$routes->get('parceiros', 'ParceirosController::index');
$routes->post('addComment', 'CommentController::addComment');
$routes->get('editComment/(:num)', 'CommentController::editComment/$1');
$routes->post('updateComment', 'CommentController::updateComment');

// Rota para o painel do administrador
$routes->get('dashboard', 'AdminController::dashboard');
$routes->get('/', 'HomeController::index');
$routes->get('post/delete/(:num)', 'PostController::deletePost/$1');

// Rotas do blog
$routes->get('blog', 'BlogController::index');
$routes->get('createpost', 'BlogController::showCreatePostForm');
$routes->post('createpost', 'BlogController::createPost');
$routes->get('viewpost2', 'BlogController::view');

// Rota para definir o idioma
$routes->get('idioma/(:any)', 'LanguageController::definirIdioma/$1');
$routes->get('post/delete/(:num)', 'PostController::delete/$1');

// Rota para visualizar comentários
$routes->get('comment/viewComments/(:num)', 'CommentController::viewComments/$1');
$routes->get('deleteComment/(:num)', 'CommentController::deleteComment/$1');
$routes->get('blog/viewpost/(:num)', 'BlogController::view/$1');

// Rota para a página de usuários
$routes->get('usuarios', 'UserController::index');
$routes->get('usuarios/adicionar', 'UserController::create');
$routes->post('usuarios/add', 'UserController::store');
$routes->post('usuarios/login', 'UserController::login');

// Rota para o localizador de pet shops
$routes->get('localizador_petshops', 'PetShopController::localizador');

// Rota para excluir comentários
$routes->get('deleteComment/(:num)', 'CommentController::deleteComment/$1');

// Rota para excluir ou atualizar posts, filtrada por autenticação
$routes->match(['get', 'post'], 'deletePost/(:num)', 'PostController::deletePost/$1', ['filter' => 'auth']);
$routes->match(['get', 'post'], 'updatePost/(:num)', 'PostController::updatePost/$1', ['filter' => 'auth']);

$routes->get('viewpost/(:num)', 'BlogController::view/$1');

$routes->post('deleteComment/(:num)', 'CommentController::deleteComment/$1');
$routes->post('updatePassword', 'AuthController::updatePassword');
$routes->post('auth/updatePassword', 'AuthController::updatePassword');

$routes->get('esqueceusenha', 'AuthController::showForgotPasswordForm');
$routes->post('esqueceusenha', 'AuthController::resetPassword');
$routes->add('esqueceusenha', 'AuthController::updatePassword');
$routes->post('esqueceusenha', 'AuthController::updatePassword');
$routes->post('updatePassword', 'AuthController::updatePassword');

$routes->add('user/delete/(:num)', 'UserController::delete/$1', ['post']);
$routes->get('user', 'UserController::showUserPage');

$routes->get('user', 'UserController::showUserPage');

$route['img'] = 'ImgController';

$routes->group('img', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('uploadForm/(:num)', 'ImgController::uploadForm/$1');
    $routes->post('visualizar_postagem/(:num)', 'ImgController::visualizar_postagem/$1');
});
