<?php

namespace App\Controllers;

use App\Models\CommentModel;
use App\Models\PostModel;
use App\Models\CategoriaModel;
use CodeIgniter\Controller;

class PostController extends BaseController
{
    // ...

    // Método para criar uma nova postagem
    public function createPost()
    {
        // Verifique se o método da requisição é POST
        if ($this->request->getMethod() === 'post') {
            // Obtenha os dados do formulário
            $title = $this->request->getPost('title');
            $content = $this->request->getPost('content');
            $categoria = $this->request->getPost('tipo_post_id'); // Corrigido para o nome do campo correto

            // Verifique se o campo de título não está vazio
            if (empty($title)) {
                return redirect()->to('createpost')->withInput()->with('error', 'O campo de título não pode estar vazio.');
            }

            // Instancie o modelo de categoria
            $categoriaModel = new CategoriaModel();
            // Obtenha o ID da categoria
            $categoriaId = $categoriaModel->getCategoryId($categoria);

            // Se a categoria não existir, crie-a
            if (!$categoriaId) {
                $categoriaId = $categoriaModel->createCategory(['nome' => $categoria]);
            }

            // Instancie o modelo de postagem
            $postModel = new PostModel();
            $data = [
                'title' => $title,
                'content' => $content,
                'tipo_post_id' => $categoriaId,
            ];

            // Use try-catch block para lidar com possíveis erros
            try {
                // Chame o método createPost do modelo
                $postModel->createPost($data);
                return redirect()->to('/blog')->with('success', 'Postagem criada com sucesso.');
            } catch (\Exception $e) {
                return redirect()->to('/blog')->with('error', 'Erro ao criar a postagem: ' . $e->getMessage());
            }
        }

        // Se o método não for POST, retorne a view do formulário de criação
        return view('createpost');
    }

    // Método para excluir uma postagem
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

    // Método para atualizar uma postagem
    public function updatePost($postId)
    {
        // Verifique se o formulário foi enviado
        if ($this->request->getMethod() === 'post') {
            // Obtenha os dados do formulário
            $title = $this->request->getPost('title');
            $content = $this->request->getPost('content');
            $categoria = $this->request->getPost('tipo_post_id'); // Corrigido para o nome do campo correto

            // Instancie o modelo de categoria
            $categoriaModel = new CategoriaModel();
            // Obtenha o ID da categoria
            $categoriaId = $categoriaModel->getCategoryId($categoria);

            // Se a categoria não existir, crie-a
            if (!$categoriaId) {
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
