<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class HomeController extends Controller
{
 // No controlador HomeController
 public function index()
 {
     // Carregue o modelo PostModel
     $postModel = new \App\Models\PostModel();
 
     // Lógica para buscar as postagens no banco de dados
     $data['posts'] = $postModel->getAllPosts(); // Substitua 'getAllPosts' pelo seu método real.
 
     return view('index', $data);
 }

    public function viewPost($post_id)
    {
        // Lógica para buscar os detalhes de uma postagem específica no banco de dados
        $data = []; // Aqui você coloca os dados da postagem

        return view('home/viewpost', $data);
    }
}

?>