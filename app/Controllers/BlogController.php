<?php

namespace App\Controllers;

use App\Models\CommentModel;
use App\Models\PostModel;
use App\Services\PostService;
use CodeIgniter\Controller;

class BlogController extends Controller
{
    private $postModel;
    private $commentModel;
    protected $servicePost;

    public function __construct()
    {
        // Instância dos modelos e serviço necessários
        $this->postModel = new PostModel();
        $this->commentModel = new CommentModel();
        $this->servicePost = new PostService();
    }

    // Método para exibir a página inicial do blog
    public function index()
    {
        // Obtém a categoria da requisição GET
        $category = $this->request->getGet('category');
        
        // Suponha que você tenha obtido o email do usuário logado da sessão
        $email = session()->get('user_email'); // Ajuste a chave da sessão conforme apropriado.

        // Obtém as postagens com base na categoria
        if ($category && $category !== 'all') {
            $posts = $this->postModel->findByCategory($category);
        } else {
            $posts = $this->postModel->findAll();
        }
        
        // Dados a serem passados para a visão
        $data = [
            'posts' => $posts,
            'selectedCategory' => $category,
            'email' => $email, // Adicione o email do usuário logado aqui
        ];
        
        // Carrega a visão 'blog' com os dados
        return view('blog', $data);
    }

    // Método para criar uma nova postagem
    public function createPost()
    {
        if ($this->request->getMethod() === 'post') {
            // Regras de validação para o formulário de criação de postagem
            $validationRules = [
                'title' => 'required|min_length[5]|max_length[255]',
                'content' => 'required',
            ];

            // Validação dos dados do formulário
            if (!$this->validate($validationRules)) {
                return redirect()->back()->withInput()->with('error', $this->validator->listErrors());
            }

            // Criação da postagem usando o serviço PostService
            if ($id_post = $this->servicePost->createPost($this->request->getPost())) {
                // Upload da imagem associada à postagem
                $this->upload_image($this->request->getFile('userfile'), $id_post);
            } else {
                return redirect()->to('/blog')->with('success', 'Postagem criada com sucesso.');
            }

            return redirect()->to('/blog')->with('success', 'Postagem criada com sucesso.');
        }

        return $this->showCreatePostForm();
    }

    // Método para realizar o upload de uma imagem associada à postagem
    private function upload_image($image, $postId)
    {
        $destinationDirectory = 'assets/imgs/';
      
        $filename = uniqid() . '_' . preg_replace('/\s+/', '', $image->getName());

        if ($image->move($destinationDirectory, $filename)) {
            // Atualiza o campo 'imagem' da postagem com o nome do arquivo
            if($this->servicePost->updatePost($postId, ['imagem' => $filename])){
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    // Método para exibir o formulário de criação de postagem
    public function showCreatePostForm()
    {
        $data['categories'] = $this->postModel->getDistinctCategories();
    
        return view('createpost', $data);
    }

    // Método para exibir uma postagem específica e seus comentários
    public function view($postID)
    {
        $post = $this->postModel->find($postID);

        if ($post) {
            // Obtém os comentários associados à postagem
            $comments = $this->commentModel->where('post_id', $postID)->findAll();

            return view('viewpost', ['post' => $post, 'comments' => $comments]);
        } else {
            return redirect()->to('/blog')->with('error', 'A postagem não foi encontrada.');
        }
    }

    // Método para exibir postagens com base em uma categoria específica
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

    // Método para exibir a página do blog com base na categoria selecionada
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
