<?php
// CommentService.php
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

    public function createComment($commentData)
    {
        $comment = new Comment($commentData);

        return $this->commentModel->insert($comment);
    }

    public function selfDelete($id)
    {
        return $this->commentModel->delete($id);
    }

    public function getUserByEmail($email)
    {
        $user = $this->userModel->select('password')->where('email', $email)->first();

        return $user ? $user->password : null;
    }
}
