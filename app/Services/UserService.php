<?php

namespace App\Services;

use App\Models\UserModel;
use CodeIgniter\HTTP\Exceptions\HTTPException;

class UserService
{
    protected $userModel;

    public function __construct(UserModel $userModel)
    {
        $this->userModel = $userModel;
    }

    public function authenticate($email, $senha)
    {
        $user = $this->userModel->where('email', $email)->first();

        if ($user && password_verify($senha, $user['password'])) {
            // Autenticação bem-sucedida, você pode retornar o usuário autenticado aqui se desejar
            return true;
        } else {
            return false;
        }
    }

    public function createUser($email, $password)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $data = [
            'email' => $email,
            'password' => $hashedPassword,
        ];

        try {
            // Tente inserir o usuário
            $result = $this->userModel->insert($data);
        
            if ($result) {
                // Registro bem-sucedido
                return true;
            } else {
                // Erro ao inserir no banco de dados
                return false;
            }
        } catch (\Exception $e) {
            // Captura a exceção e registra-a para depuração
            log_message('error', 'Exceção durante a inserção do usuário: ' . $e->getMessage());
            return false;
        }
    }
}
