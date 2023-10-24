<?php

namespace App\Controllers;

use App\Models\PostModel;
use App\Models\CategoriaModel;
use CodeIgniter\Controller;

class PostController extends BaseController
{
    public function index()
    {
        // Lógica para exibir a página de criação de posts
        return view('createpost');
    }

    public function createPost()
    {
        if ($this->request->getMethod() === 'post') {
            // Recupere os dados do formulário
            $title = $this->request->getPost('title');
            $content = $this->request->getPost('content');
            $categoria = $this->request->getPost('categoria');
    
            // Validar o campo 'title'
            if (empty($title)) {
                return redirect()->to('createpost')->withInput()->with('error', 'O campo de título não pode estar vazio.');
            }
    
            // Verificar se a categoria existe
            $categoriaModel = new CategoriaModel(); // Certifique-se de que a classe CategoriaModel está definida corretamente
            $categoriaId = $categoriaModel->getCategoryId($categoria);
    
            // Se a categoria não existe, crie-a
            if (!$categoriaId) {
                $categoriaId = $categoriaModel->createCategory(['nome' => $categoria]);
            }
    
            // Crie uma instância do modelo PostModel
            $postModel = new PostModel();
    
            // Faça a lógica de inserção no banco de dados usando o modelo PostModel
            $data = [
                'title' => $title,
                'content' => $content,
                'tipo_post_id' => $categoriaId,
            ];
            $postModel->createPost($data);
    
            return redirect()->to('/blog')->with('success', 'Postagem criada com sucesso.');
        }
    
        return view('createpost');
    }
}    
