<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;
use App\Models\CommentModel;
use App\Services\CommentService;

class CommentController extends Controller
{
    // Propriedades para os serviços e modelos necessários
    protected $commentService;
    protected $userModel;
    protected $commentModel;

    // Construtor para inicializar os serviços e modelos
    public function __construct()
    {
        $this->commentService = new CommentService();
        $this->userModel = new UserModel();
        $this->commentModel = new CommentModel();
    }

    // Método para adicionar um comentário
    public function addComment()
    {
        // Configuração das regras de validação
        $validation = \Config\Services::validation();
        $validation->setRules([
            'content' => 'required'
        ]);

        // Criação do comentário usando o CommentService
        if ($this->commentService->createComment($this->request->getPost())) {
            session()->setFlashdata('success', 'Comentário gravado com sucesso');
        } else {
            session()->setFlashdata('error', 'Erro ao gravar o comentário');
        }

        return redirect()->back();
    }

    // Método para editar um comentário
    public function editComment($commentId)
    {
        // Busca o comentário pelo ID
        $comment = $this->commentModel->find($commentId);

        // Verifica se o comentário foi encontrado
        if (!$comment) {
            return redirect()->back()->with('error', 'Comentário não encontrado.');
        }

        // Retorna a visão 'edit_comment' com os dados do comentário
        return view('edit_comment', ['comment' => $comment]);
    }

    // Método para atualizar um comentário
    public function updateComment()
    {
        // Obtém os dados do formulário
        $commentId = $this->request->getPost('comment_id');
        $newContent = $this->request->getPost('new_content');

        // Verifica se os dados são válidos
        if (!$commentId || !$newContent) {
            return redirect()->back()->with('error', 'Dados inválidos para atualização do comentário.');
        }

        // Busca o comentário pelo ID
        $comment = $this->commentModel->find($commentId);

        // Verifica se o comentário foi encontrado
        if (!$comment) {
            return redirect()->back()->with('error', 'Comentário não encontrado.');
        }

        // Atualiza o conteúdo do comentário
        $comment->content = $newContent;
        $this->commentModel->save($comment);

        // Redireciona de volta à página da postagem associada ao comentário
        return redirect()->to('/viewpost/' . $comment->post_id)->with('success', 'Comentário atualizado com sucesso.');
    }

    // Método para excluir um comentário
    public function deleteComment($commentId)
    {
        // Busca o comentário pelo ID
        $comment = $this->commentModel->find($commentId);

        // Verifica se o comentário foi encontrado
        if (!$comment) {
            return redirect()->back()->with('error', 'Comentário não encontrado.');
        }

        // Verifica a autorização para exclusão
        if ($comment->user_id !== session()->get('user_id')) {
            return redirect()->back()->with('error', 'Você não tem permissão para excluir este comentário.');
        }

        // Exclui o comentário
        $this->commentModel->delete($commentId);

        // Redireciona de volta à página da postagem associada ao comentário
        return redirect()->to('/viewpost/' . $comment->post_id)->with('success', 'Comentário excluído com sucesso.');
    }
}
