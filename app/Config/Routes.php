<?php
$routes->get('login', 'AuthController::showLoginForm');
$routes->post('login', 'AuthController::authenticate');
$routes->get('register', 'AuthController::showRegistrationForm'); // Alterei para 'showRegistrationForm'
$routes->post('register', 'AuthController::createUser');
$routes->get('logout', 'AuthController::logout');
$routes->get('blog/viewpost/(:num)', 'BlogController::view/$1');
$routes->get('blog/filterByCategory', 'BlogController::filterByCategory');
$routes->get('bem-vindo', 'AuthController::BemVindo');
$routes->get('parceiros', 'ParceirosController::index');
$routes->post('addComment', 'CommentController::addComment');
$routes->get('editComment/(:num)', 'CommentController::editComment/$1'); // Adicionei a rota para editar comentários
$routes->post('updateComment', 'CommentController::updateComment'); // Adicionei a rota para atualizar comentários

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
$routes->get('usuarios', 'UserController::index'); // Alterei para UserController
$routes->get('usuarios/adicionar', 'UserController::create'); // Alterei para UserController
$routes->post('usuarios/add', 'UserController::store'); // Alterei para UserController
$routes->post('usuarios/login', 'UserController::login'); // Adicionei uma rota para o login de usuário

// Rota para o localizador de pet shops
$routes->get('localizador_petshops', 'PetShopController::localizador');

// Rota para excluir comentários
$routes->get('deleteComment/(:num)', 'CommentController::deleteComment/$1');

$routes->get('viewpost/(:num)', 'BlogController::view/$1');
$routes->post('deleteComment/(:num)', 'CommentController::deleteComment/$1');
$routes->post('updatePassword', 'AuthController::updatePassword');
$routes->post('auth/updatePassword', 'AuthController::updatePassword');

$routes->get('esqueceusenha', 'AuthController::showForgotPasswordForm');
$routes->post('esqueceusenha', 'AuthController::resetPassword');
$routes->add('esqueceusenha', 'AuthController::updatePassword');
$routes->post('esqueceusenha', 'AuthController::updatePassword');
$routes->post('updatePassword', 'AuthController::updatePassword');


$routes->get('user', 'UserController::showUserPage');

