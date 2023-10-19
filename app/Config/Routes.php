<?php
$routes->group('', ['namespace' => 'App\Controllers'], function ($routes) {
    // Rotas de autenticação
    $routes->get('login', 'AuthController::showLoginForm');
    $routes->post('login', 'AuthController::authenticate');
    $routes->get('register', 'AuthController::register');
    $routes->post('register', 'AuthController::createUser');
    $routes->get('logout', 'AuthController::logout');

    // Rota para o painel do administrador
    $routes->get('dashboard', 'AdminController::dashboard');
    $routes->get('/', 'HomeController::index'); // Rota da página inicial

    // Rotas do blog
    $routes->get('blog', 'BlogController::index');
    $routes->get('blog/viewpost/(:num)', 'BlogController::view/$1');
    $routes->get('blog/filterByCategory', 'BlogController::filterByCategory');
    $routes->get('createpost', 'BlogController::showCreatePostForm');
    $routes->post('createpost', 'BlogController::createPost');
    $routes->get('viewpost2', 'BlogController::view');

    // Rota para definir o idioma
    $routes->get('idioma/(:any)', 'LanguageController::definirIdioma/$1');

    // Rota para adicionar comentários
    $routes->post('addComment', 'CommentController::addComment');

    // Rota para visualizar comentários
    $routes->get('comment/viewComments/(:num)', 'CommentController::viewComments/$1');

    // Rota para a página de usuários
    $routes->get('usuarios', 'Usuarios::index', ['as' => 'login']);
    $routes->get('usuarios/adicionar', 'Usuarios::adicionar');
    $routes->post('usuarios/add', 'Usuarios::add');
    $routes->post('usuarios/login', 'Usuarios::login');

    // Rota para o localizador de pet shops
    $routes->get('localizador_petshops', 'PetShopController::localizador');
});
