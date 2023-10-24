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

        if ($this->postModel->insert($post)) {
            return true;
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
        $post = new Post($postData);

        if ($this->postModel->update($id, $post)) {
            return true;
        } else {
            return false;
        }
    }

    public function deletePost($id)
    {
        return $this->postModel->delete($id);
    }

}
