<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;
use App\Models\CommentModel;
use App\Services\CommentService;

class CommentController extends Controller
{
    protected $commentService;
    protected $userModel;

    public function __construct()
    {
        $this->commentService = new CommentService();
        $this->userModel = new UserModel();
        $this->commentModel = new CommentModel();
    }

    public function addComment()
{
    $validation = \Config\Services::validation();

    $validation->setRules([
        'content' => 'required'
    ]);
// debug ($this->request->getPost());
    if ($this->commentService->createComment($this->request->getPost())) {
        session()->setFlashdata('success', 'Comentário gravado com sucesso');
        return redirect()->back();
    } else {
        return redirect()->back();
    }
}

public function viewComments($postId)
{
    // Recupere os comentários associados a uma postagem específica
    $comments = $this->commentModel->where('post_id', $postId)->findAll();

    // Recupere a postagem específica
    $post = $this->postModel->find($postId);

    // Carregue a visualização com os comentários e a postagem
    return view('/viewpost', ['comments' => $comments, 'post' => $post]);
}
}