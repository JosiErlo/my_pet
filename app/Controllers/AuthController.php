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
        if ($this->request->getMethod() === 'post') {
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            if ($userFind = $this->userService->authenticate($email, $password)) {

                $userData = array(
                    'user_id' => $userFind->id,
                    'email' => $userFind->email,
                    'birthdate' => $userFind->birthdate,
                    'loggedin' => true,
                );

                session()->set($userData);
                return redirect()->to('/blog');
            } else {
                $data['error'] = 'Usuário ou senha incorretos.';
                return view('login', $data);
            }
        }

        return view('login');
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
            return redirect()->to('/blog');
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
        // Coletar dados do formulário
        $title = $this->request->getPost('title');
        $content = $this->request->getPost('content');
        $category = $this->request->getPost('categoria');

        // Adicione a data/hora atual ao campo 'created_at'
        $created_at = date('Y-m-d H:i:s');

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
            'created_at' => $created_at, // Adicione a data/hora atual
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
    public function viewPost($postId)
    {
        // Recupere a postagem completa com base no $postId
        $postModel = new \App\Models\PostModel(); // Substitua com a lógica real
        $post = $postModel->getPostById($postId);

        if ($post) {
            // Carregue a visualização com os dados da postagem completa
            return view('viewpost', ['post' => $post]);
        } else {
            // Trate o caso em que a postagem não foi encontrada
            // Pode ser uma boa prática exibir uma mensagem de erro ou redirecionar para a página de blog.
        }
    }
    public function showForgotPasswordForm()
    {
        return view('esqueceusenha');
    }
    public function sendPasswordResetLink()
    {
        // Obtenha o email do formulário
        $email = $this->request->getPost('email');

        // Gere um token de redefinição de senha aleatório
        $resetToken = bin2hex(random_bytes(32));

        // Atualize o banco de dados para armazenar o token associado ao email do usuário
        // Este é um exemplo simplificado, você precisará adaptá-lo ao seu banco de dados e modelo de usuário

        // Redirecione para uma página de confirmação
        return view('password_reset_sent');
    }
}
