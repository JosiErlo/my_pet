<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\CommentModel;
use App\Models\UserModel; // Importe a classe UserModel

class CommentController extends Controller
{
    protected $commentModel;
    protected $userModel;

    public function __construct()
    {
        $this->commentModel = new CommentModel();
        $this->userModel = new UserModel(); // Agora você pode instanciar a classe UserModel
    }

    public function addComment()
    {
        if ($this->request->getMethod() === 'post') {
            $postID = $this->request->getPost('post_id');
            $commentText = $this->request->getPost('content');
            $userID = $this->request->getPost('user_id');
            $created = date('Y-m-d H:i:s');
           
            debug($this->request->getPost());
            // Verifique se o usuário com o ID especificado existe
            $user = $this->userModel->find($userID);
            if (!$user) {
                return redirect()->to(site_url('blog/viewpost/' . $postID))->with('error', 'Usuário não encontrado.');
            }
    
            // Crie um array com os dados do comentário
            $commentData = [
                'post_id' => $postID,
                'content' => $commentText,
                'user_id' => $userID,
                'created_at' => $created, // Inclua a data de criação
            ];
    
            // Insira o comentário no banco de dados
            $this->commentModel->insert($commentData);
    
            // Redirecione de volta à página de visualização da postagem
            return redirect()->to(site_url('blog/viewpost/' . $postID))->with('success', 'Comentário adicionado com sucesso.');
        }
    }
    




    public function viewComments($postId)
    {
        // Recupere os comentários associados a uma postagem específica
        $comments = $this->commentModel->where('post_id', $postId)->findAll();

        // Carregue a visualização com os comentários
        return view('/viewpost', ['content' => $comments]);
    }
}
