<?php

namespace App\Controllers;

use App\Models\PostModel;
use App\Models\CategoriaModel; // Importe a classe CategoriaModel corretamente

class CreatePostController extends BaseController
{
    public function index()
    {
        // Lógica para exibir a página de criação de posts
        return view('createpost');
    }

    public function metodoCreatePost()
    {
        if ($this->request->getMethod() === 'post') {
            // Recupere os dados do formulário
            $titulo = $this->request->getPost('title');
            $conteudo = $this->request->getPost('content');
            $categoria = $this->request->getPost('categoria');
    
            // Valide o campo 'title'
            if (empty($titulo)) {
                return redirect()->to('createpost')->withInput()->with('error', 'O campo de título não pode estar vazio.');
            }
    
            // Verifique se a categoria existe
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
                'title' => $titulo,
                'content' => $conteudo,
                'tipo_post_id' => $categoriaId,
            ];
            $postModel->createPost($data);
    
            return redirect()->to('/blog')->with('success', 'Postagem criada com sucesso.');
        }
    
        return view('createpost');
    }
}
