<?php

namespace App\Services;

use App\Entities\Comment;
use App\Models\CommentModel;
use App\Models\UserModel;
class CommentService
{
    protected $commentModel;
    protected $userModel;
    public function __construct()
    {
        $this->commentModel = new CommentModel();
        $this->userModel = new UserModel();
    }

    public function createComment($comment)
    {
        $comment = new Comment($comment);

        if ($this->commentModel->insert($comment)) {
            return true;
        } else {
            return false;
        }
    }

    public function selfDelete($id)
    {
        if ($this->commentModel->delete($id)) {
            return true;
        } else {
            return false;
        }
    }

    // Novo método para buscar um usuário pelo email
    public function getUserByEmail($email)
    {
        $user = $this->userModel->select('password')->where('email', $email)->first();

        return $user ? $user->password : null;
    }
}