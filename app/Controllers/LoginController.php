<?php
namespace App\Controllers;

class AuthController extends BaseController {

    public function login()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
    
        // Consulte o banco de dados para obter o usuário pelo email
        $user = $this->userService->getUserByEmail($email);
    
        if ($user && password_verify($password, $user->password)) {
            // Credenciais corretas, redirecionar para a página de login
            $_SESSION['loggedin'] = true;
            return redirect()->to('login'); // Redirecionar para a página de login
        } else {
            // Credenciais incorretas, exibir mensagem de erro
            $erro = 'Usuário ou senha incorretos.';
            return view('login', ['erro' => $erro]);
        }
    }
}
    
?>
