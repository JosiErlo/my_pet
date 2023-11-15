<?php

namespace App\Services;

use App\Entities\Post;
use App\Models\PostModel;

class PostService
{
    protected $postModel;

    public function __construct()
    {
        $this->postModel = new PostModel();
    }

    public function createPost($postData)
    {
        $post = new Post($postData);

        if ($id = $this->postModel->createPost($post)) {
            return $id;
        } else {
            return false;
        }
    }

    public function readPost($id)
    {
        return $this->postModel->find($id);
    }

    public function updatePost($id, $postData)
    {
        // Busca o post pelo ID
        $post = $this->postModel->find($id);
       
        // Verifica se o post foi encontrado
        if (!$post) {
            return false; // Ou outra indicação de falha
        }

        // Preenche os dados do post com os novos dados
        $post->fill($postData);
       
        // Realiza a atualização no banco de dados
        if ($this->postModel->updateImagePost($post)) {
            return true;
        } else {
            return false; // Ou outra indicação de falha
        }
    }

    public function deletePost($id)
    {
        return $this->postModel->delete($id);
    }
}
