<?php

namespace App\Controllers;

use App\Models\CommentModel;
use App\Models\PostModel;
use App\Models\CategoriaModel;
use CodeIgniter\Controller;

class PostController extends BaseController
{
    // ...

    public function createPost()
    {
        if ($this->request->getMethod() === 'post') {
            $title = $this->request->getPost('title');
            $content = $this->request->getPost('content');
            $categoria = $this->request->getPost('tipo_post_id'); // Corrigido para o nome do campo correto

            if (empty($title)) {
                return redirect()->to('createpost')->withInput()->with('error', 'O campo de título não pode estar vazio.');
            }

            $categoriaModel = new CategoriaModel();
            $categoriaId = $categoriaModel->getCategoryId($categoria);

            if (!$categoriaId) {
                $categoriaId = $categoriaModel->createCategory(['nome' => $categoria]);
            }

            $postModel = new PostModel();
            $data = [
                'title' => $title,
                'content' => $content,
                'tipo_post_id' => $categoriaId,
            ];
            
            // Use try-catch block para lidar com possíveis erros
            try {
                $postModel->createPost($data);
                return redirect()->to('/blog')->with('success', 'Postagem criada com sucesso.');
            } catch (\Exception $e) {
                return redirect()->to('/blog')->with('error', 'Erro ao criar a postagem: ' . $e->getMessage());
            }
        }

        return view('createpost');
    }
    public function deletePost($postId)
    {
        // Instancie o modelo de comentários
        $commentModel = new CommentModel();
    
        // Exclua os comentários relacionados à postagem
        $commentModel->where('post_id', $postId)->delete();
    
        // Instancie o modelo de postagens
        $postModel = new PostModel();
    
        // Chame o método deletePost do modelo
        if ($postModel->deletePost($postId)) {
            return redirect()->to('/blog')->with('success', 'Postagem excluída com sucesso.');
        } else {
            return redirect()->to('/blog')->with('error', 'Postagem não encontrada ou você não tem permissão para excluí-la.');
        }
    }
    
    public function updatePost($postId)
{
    // Verifique se o formulário foi enviado
    if ($this->request->getMethod() === 'post') {
        $title = $this->request->getPost('title');
        $content = $this->request->getPost('content');
        $categoria = $this->request->getPost('tipo_post_id'); // Corrigido para o nome do campo correto

        // Validações de campos, se necessário...

        // Obtém o ID da categoria
        $categoriaModel = new CategoriaModel();
        $categoriaId = $categoriaModel->getCategoryId($categoria);

        if (!$categoriaId) {
            // Se a categoria não existe, crie-a
            $categoriaId = $categoriaModel->createCategory(['nome' => $categoria]);
        }

        // Dados a serem atualizados
        $data = [
            'title' => $title,
            'content' => $content,
            'tipo_post_id' => $categoriaId,
        ];

        // Instancie o modelo de postagens
        $postModel = new PostModel();

        // Use try-catch para lidar com possíveis erros
        try {
            // Chame o método updatePost do modelo
            $postModel->updatePost($postId, $data);
            return redirect()->to('/viewpost')->with('success', 'Postagem atualizada com sucesso.');
        } catch (\Exception $e) {
            return redirect()->to('/blog')->with('error', 'Erro ao atualizar a postagem: ' . $e->getMessage());
        }
    }
}
}