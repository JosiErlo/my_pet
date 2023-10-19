<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\CommentModel;
use App\Models\UserModel;

class CommentController extends Controller
{
    protected $commentModel;
    protected $userModel;

    public function __construct()
    {
        $this->commentModel = new CommentModel();
        $this->userModel = new UserModel();
    }

    public function addComment()
    {
        if (!session()->get('loggedin')) {
            return redirect()->to('login')->with('error', 'Você precisa fazer login para criar um comentário.');
        }
        if ($this->request->getMethod() === 'post') {
            $validation = \Config\Services::validation();
            $validationRules = [
                'content' => 'required',
                'user_id' => 'required',
                'post_id' => 'required',
            ];
    // debug($this->request->getPost());
            if (!$this->validate($validationRules)) {
                return redirect()->to(site_url('blog/viewpost/' . $this->request->getPost('post_id')))
                    ->with('errors', $validation->getErrors());
            }
    
            $commentText = $this->request->getPost('content');
            $userID = $this->request->getPost('user_id');
            $postID = $this->request->getPost('post_id');
            $user = $this->userModel->find($userID);
    
            if (!$user) {
                return redirect()->to(site_url('blog/viewpost/' . $postID))->with('error', 'Usuário não encontrado.');
            }
    
            // Crie um array com os dados do comentário
            $commentData = [
                'post_id' => $postID,
                'content' => $commentText,
                'user_id' => $userID,
                'created_at' => date('Y-m-d H:i:s'),
            ];
    
            // Obtenha o serviço de banco de dados padrão do CodeIgniter
            $db = \Config\Database::connect();
    
            // Inserir o comentário no banco de dados usando o Query Builder
            $db->table('comments')->insert($commentData);
    
            // Redirecione de volta à página de visualização da postagem
            return redirect()->to(site_url('blog/viewpost/' . $postID))->with('success', 'Comentário adicionado com sucesso.');
        }
    }    


    
    

    public function viewComments($postId)
    {
        $comments = $this->commentModel->where('post_id', $postId)->findAll();

        // Carregue a visualização de postagem junto com os comentários
        $postModel = new \App\Models\PostModel();
        $post = $postModel->find($postId);

        return view('viewpost', ['post' => $post, 'comments' => $comments]);
    }

// debug($this->request->getPost());

}