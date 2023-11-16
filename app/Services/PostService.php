<?php

namespace App\Services;

use App\Entities\Post;
use App\Models\PostModel;

class PostService
{
    protected $postModel;

    // Construtor da classe PostService.
    public function __construct()
    {
        // Inicializa a instância do modelo necessária.
        $this->postModel = new PostModel();
    }

    // Método para criar um novo post.
    public function createPost($postData)
    {
        // Cria uma instância da entidade Post a partir dos dados fornecidos.
        $post = new Post($postData);

        // Chama o método createPost do modelo PostModel para inserir o post no banco de dados.
        if ($id = $this->postModel->createPost($post)) {
            return $id;
        } else {
            return false;
        }
    }

    // Método para ler um post pelo ID.
    public function readPost($id)
    {
        // Chama o método find do modelo PostModel para obter o post pelo ID.
        return $this->postModel->find($id);
    }

    // Método para atualizar um post pelo ID.
    public function updatePost($id, $postData)
    {
        // Busca o post pelo ID.
        $post = $this->postModel->find($id);

        // Verifica se o post foi encontrado.
        if (!$post) {
            return false; // Ou outra indicação de falha
        }

        // Preenche os dados do post com os novos dados.
        $post->fill($postData);

        // Realiza a atualização no banco de dados chamando o método updateImagePost do modelo PostModel.
        if ($this->postModel->updateImagePost($post)) {
            return true;
        } else {
            return false; // Ou outra indicação de falha
        }
    }

    // Método para excluir um post pelo ID.
    public function deletePost($id)
    {
        // Chama o método delete do modelo PostModel para excluir o post pelo ID.
        return $this->postModel->delete($id);
    }
}
