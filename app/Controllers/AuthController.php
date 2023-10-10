<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Services\UserService;

class AuthController extends Controller
{
    protected $userService;

    public function __construct()
    {
        // Obtenha as dependências usando o Service Container
        $this->userService = service('userService');
    }

    public function index()
    {
        $isLoggedIn = session()->get('loggedin');
        
        // Carregar os posts do blog, se necessário
        // ...
        
        // Passar a variável $isLoggedIn para a visualização
        return view('index', ['isLoggedIn' => $isLoggedIn]);
    }
    

    public function register()
    {
        // Página de registro
        return view('register');
    }

    public function authenticate()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        if ($this->userService->authenticate($email, $password)) {
            $_SESSION['loggedin'] = true;
            return redirect()->to('/blog');
        } else {
            $data['error'] = 'Usuário ou senha incorretos.';
            return view('login', $data);
        }
    }

    public function showRegistrationForm()
    {
        // Página de registro
        return view('register');
    }

    public function showLoginForm()
    {
        // Verifique se o usuário já está autenticado
        if (session()->get('loggedin')) {
            // Usuário já autenticado, redirecione para a página de boas-vindas
            return redirect()->to('/bem-vindo');
        }

        // Se o usuário não estiver autenticado, exiba a página de formulário de login
        return view('login');
    }

    public function createUser()
    {
        $postData = $this->request->getPost();

        if ($this->userService->createUser($postData)) {
            return redirect('/');
        }

        // Se o método errors() existir na classe UserService
        // você pode usá-lo para obter os erros
        $data['errors'] = method_exists($this->userService, 'errors') ? $this->userService->errors() : [];

        return view('register', $data);
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }

    public function BemVindo()
    {
        // Verifique se o usuário está autenticado
        if (session()->get('loggedin')) {
            // Recupere o email da sessão
            $userEmail = session()->get('user_email');
            
            // Exiba a mensagem de boas-vindas com o email do usuário
            return 'Bem-vindo, ' . $userEmail;
        } else {
            // Defina uma mensagem padrão se o usuário não estiver autenticado
            return 'Bem-vindo ao nosso blog!';
        }
    }
    public function createPost()
    {
        // Verifique se o usuário está autenticado
        if (!session()->get('loggedin')) {
            // Se o usuário não estiver autenticado, redirecione para a página de login
            return redirect()->to('/login');
        }
    
        // Coletar dados do formulário
        $title = $this->request->getPost('title');
        $content = $this->request->getPost('content');
        $category = $this->request->getPost('categoria');
    
        // Validar os dados usando as ferramentas de validação do CodeIgniter
        $validation = \Config\Services::validation();
        $validation->setRules([
            'title' => 'required|min_length[5]',
            'content' => 'required|min_length[10]',
            'categoria' => 'required',
        ]);
    
        if (!$validation->withRequest($this->request)->run()) {
            // Se a validação falhar, redirecione de volta ao formulário de criação com mensagens de erro
            return redirect()->to('/createpost')->withInput()->with('errors', $validation->getErrors());
        }
    
        // Criar o post
        $postModel = new \App\Models\PostModel();
        $postData = [
            'title' => $title,
            'content' => $content,
            'category' => $category,
            // Outros campos, se houver
        ];
    
        try {
            // Chame o método createPost do modelo
            if ($postModel->createPost($postData)) {
                // Post criado com sucesso, redirecione para a página de blog ou para onde desejar
                return redirect()->to('/blog');
            } else {
                // Lidar com erros, se a criação do post falhar
                // Você pode redirecionar de volta ao formulário de criação com mensagens de erro, por exemplo
                // return redirect()->to('/createpost')->withInput()->with('errors', $postModel->errors());
            }
        } catch (\Exception $e) {
            // Lidar com exceções, se ocorrerem
            // Você pode redirecionar de volta ao formulário de criação com mensagens de erro personalizadas
            // return redirect()->to('/createpost')->withInput()->with('error', 'Ocorreu um erro ao criar o post: ' . $e->getMessage());
        }
    }
}    