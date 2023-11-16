<?php

namespace App\Controllers;
use App\Models\Parceiro; 
class AuthController extends BaseController {

    // Método para lidar com o processo de login
    public function login()
    {
        // Obtém o email e senha do formulário de login
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
    
        // Consulta o banco de dados para obter o usuário pelo email
        $user = $this->userService->getUserByEmail($email);
    
        // Verifica se o usuário existe e a senha está correta
        if ($user && password_verify($password, $user->password)) {
            // Credenciais corretas, define a sessão como autenticada e redireciona para a página de login
            $_SESSION['loggedin'] = true;
            return redirect()->to('login'); // Redireciona para a página de login
        } else {
            // Credenciais incorretas, exibe mensagem de erro na página de login
            $erro = 'Usuário ou senha incorretos.';
            return view('login', ['erro' => $erro]);
        }
    }
}

