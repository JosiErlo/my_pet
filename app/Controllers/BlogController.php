<?php

namespace App\Controllers;

use App\Models\CommentModel;
use App\Models\PostModel;
use CodeIgniter\Controller;

class BlogController extends Controller
{
    private $postModel;
    private $commentModel;

    public function __construct()
    {
        $this->postModel = new PostModel();
        $this->commentModel = new CommentModel();
    }

    public function index()
    {
        $category = $this->request->getGet('category'); // Obtém a categoria da consulta GET
    
        if ($category && $category !== 'all') {
            $posts = $this->postModel->findByCategory($category);
        } else {
            $posts = $this->postModel->findAll();
        }
    
        $data = [
            'posts' => $posts,
            'selectedCategory' => $category,
        ];
    
        return view('blog', $data);
    }

    public function createPost()
    {
        if ($this->request->getMethod() === 'post') {
            // Valide os dados do formulário
            $validationRules = [
                'title' => 'required|min_length[5]|max_length[255]',
                'content' => 'required',
            ];

            if (!$this->validate($validationRules)) {
                return redirect()->back()->withInput()->with('error', $this->validator->listErrors());
            }

            $this->postModel->insert($this->request->getPost());

            return redirect()->to('/blog')->with('success', 'Postagem criada com sucesso.');
        }

        return $this->showCreatePostForm();
    }

    public function showCreatePostForm()
    {
        // Recupere todas as categorias diretamente
        $data['categories'] = $this->postModel->distinct('tipo_post_id')->findAll();
    
        return view('createpost', $data);
    }
    

    public function view($postID)
    {
        // Recupere os detalhes da postagem com base no ID
        $post = $this->postModel->find($postID);

        if ($post) {
            // Recupere os comentários associados a esta postagem
            $comments = $this->commentModel->where('post_id', $postID)->findAll();

            // Se a postagem existe, carregue a visualização e passe os dados da postagem e os comentários para ela
            return view('viewpost', ['post' => $post, 'comments' => $comments]);
        } else {
            // Se a postagem não existe, você pode redirecionar para uma página de erro ou fazer o que for apropriado.
            return redirect()->to('/blog')->with('error', 'A postagem não foi encontrada.');
        }
    }

    public function viewByCategory($category)
    {
        $data['categories'] = $this->postModel->getAllCategories();

        if ($category === 'all') {
            // Se 'all' for selecionado, carregue todos os posts
            $data['posts'] = $this->postModel->findAll();
        } else {
            // Caso contrário, filtre os posts pela categoria selecionada
            $data['posts'] = $this->postModel->findByCategory($category);
        }

        return view('blog', $data);
    }
    public function filterByCategory()
    {
        $category = $this->request->getGet('categoria'); // Obtém a categoria da consulta GET
    
        if ($category && $category !== 'all') {
            $posts = $this->postModel->findByCategory($category);
        } else {
            $posts = $this->postModel->findAll();
        }
    
        $data = [
            'posts' => $posts,
            'selectedCategory' => $category,
        ];
    
        return view('blog', $data);
    }
    
}
