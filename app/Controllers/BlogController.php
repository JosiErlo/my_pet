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
        $category = $this->request->getGet('category');
    
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
        $data['categories'] = $this->postModel->getDistinctCategories();
    
        return view('createpost', $data);
    }

    public function view($postID)
    {
        $post = $this->postModel->find($postID);

        if ($post) {
            $comments = $this->commentModel->where('post_id', $postID)->findAll();

            return view('viewpost', ['post' => $post, 'comments' => $comments]);
        } else {
            return redirect()->to('/blog')->with('error', 'A postagem não foi encontrada.');
        }
    }

    public function viewByCategory($category)
    {
        $data['categories'] = $this->postModel->getDistinctCategories();

        if ($category === 'all') {
            $data['posts'] = $this->postModel->findAll();
        } else {
            $data['posts'] = $this->postModel->findByCategory($category);
        }

        return view('blog', $data);
    }

    public function blog()
    {
        $request = service('request');
        $selectedCategory = $request->getGet('tipo_post_id') ?? 'all';
    
        $data = [
            'selectedCategory' => $selectedCategory,
        ];
    
        return view('blog', $data);
    }
}
