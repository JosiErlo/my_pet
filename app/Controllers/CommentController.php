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
    protected $commentModel;

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

        if ($this->commentService->createComment($this->request->getPost())) {
            session()->setFlashdata('success', 'Comentário gravado com sucesso');
        } else {
            session()->setFlashdata('error', 'Erro ao gravar o comentário');
        }

        return redirect()->back();
    }

    public function editComment($commentId)
    {
        $comment = $this->commentModel->find($commentId);
    
        if (!$comment) {
            return redirect()->back()->with('error', 'Comentário não encontrado.');
        }
    
    
    
        return view('edit_comment', ['comment' => $comment]);
    }
    public function updateComment()
    {
        $commentId = $this->request->getPost('comment_id');
        $newContent = $this->request->getPost('new_content');

        if (!$commentId || !$newContent) {
            return redirect()->back()->with('error', 'Dados inválidos para atualização do comentário.');
        }

        $comment = $this->commentModel->find($commentId);

        if (!$comment) {
            return redirect()->back()->with('error', 'Comentário não encontrado.');
        }

        // Verifique a autorização para edição (se necessário)

        // Atualize o conteúdo do comentário
        $comment->content = $newContent;
        $this->commentModel->save($comment);

        return redirect()->to('/viewpost/' . $comment->post_id)->with('success', 'Comentário atualizado com sucesso.');
    }

    public function deleteComment($commentId)
    {
        $comment = $this->commentModel->find($commentId);

        if (!$comment) {
            return redirect()->back()->with('error', 'Comentário não encontrado.');
        }

        // Verifique a autorização para exclusão
        if ($comment->user_id !== session()->get('user_id')) {
            return redirect()->back()->with('error', 'Você não tem permissão para excluir este comentário.');
        }

        // Exclua o comentário
        $this->commentModel->delete($commentId);

        return redirect()->to('/viewpost/' . $comment->post_id)->with('success', 'Comentário excluído com sucesso.');
    }
}
