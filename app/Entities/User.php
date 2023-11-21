<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;
use App\Controllers\BaseController;
use App\Models\UserModel; // Adicione a importação para UserModel

class User extends Entity {}

class UserAuthController extends BaseController
{
    private $userModel;

    public function __construct()
    {
        // Inicialize o modelo de usuário
        $this->userModel = new UserModel();
    }

    public function authenticate()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // Consulte o banco de dados para verificar as credenciais
        $user = $this->userModel->where('email', $email)->first();

        if ($user && password_verify($password, $user->password)) {
            // Credenciais corretas, autentique o usuário como desejado
            // Por exemplo, você pode definir uma sessão de autenticação aqui
            $_SESSION['loggedin'] = true;
            return redirect()->to('/blog');
        } else {
            // Credenciais incorretas, exibir mensagem de erro
            $erro = 'Usuário ou senha incorretos.';
            return view('login', ['erro' => $erro]);
        }
    }

    public function login()
    {
        return view('login'); // Exibe o formulário de login
    }
}
