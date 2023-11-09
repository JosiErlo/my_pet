<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;

class AuthController extends Controller
{
    
 
        protected $userService;
        protected $userModel;
    
        public function __construct()
        {
            $this->userService = service('userService');
            $this->userModel = new UserModel(); // Injete o UserModel no construtor
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
                $userData = [
                    'user_id' => $userFind->id,
                    'email' => $userFind->email,
                    'userName' => $userFind->userName, // Adicione o nome do usuário aqui
                    'birthdate' => $userFind->birthdate,
                    'loggedin' => true,
                ];
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

        $userData = [
            'email' => $postData['email'],
            'password' => password_hash($postData['password'], PASSWORD_BCRYPT),
            'birthdate' => $postData['birthdate'],
            'mother_name' => $postData['mother_name'],
        ];

        // Se o usuário for criado com sucesso, redirecione ou faça o que for necessário
        if ($this->userService->createUser($userData)) {
            return redirect('/');
        }

        $data['errors'] = method_exists($this->userService, 'getErrors') ? $this->userService->getErrors() : [];

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
            $userEmail = session()->get('email');

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
        $category = $this->request->getPost('category');

        // Adicione a data/hora atual ao campo 'created_at'
        $created_at = date('Y-m-d H:i:s');

        // Validar os dados usando as ferramentas de validação do CodeIgniter
        $validation = \Config\Services::validation();
        $validation->setRules([
            'title' => 'required|min_length[5]',
            'content' => 'required|min_length[10]',
            'category' => 'required',
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
            'created_at' => $created_at,
            // Adicione a data/hora atual
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

    public function updatePassword()
    {
        $email = $this->request->getPost('email');
        $birthdate = $this->request->getPost('birthdate');
        $motherName = $this->request->getPost('mother_name');
        $newPassword = $this->request->getPost('new_password');
    
        // Consulte o banco de dados para encontrar o usuário com base no email, data de nascimento e nome da mãe.
        $userModel = new UserModel();
        $user = $userModel->where('email', $email)
            ->where('birthdate', $birthdate)
            ->where('mother_name', $motherName)
            ->first();
    
        if (!$user) {
            return redirect()->to('/auth/showForgotPasswordForm')->with('error', 'Informações incorretas. Tente novamente.');
        }
    
        // Atualize a senha do usuário
        $user->password = password_hash($newPassword, PASSWORD_BCRYPT);
        $userModel->save($user);
    
        return redirect()->to('login')->with('success', 'Senha atualizada com sucesso. Faça o login com sua nova senha.');
    }
    
    public function showUserPage()
{
    // Lógica para exibir a página do usuário
    return view('blog'); // Substitua 'user_page' pelo nome da sua visão
}

}    