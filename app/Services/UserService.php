<?php

namespace App\Services;

use App\Entities\User;
use App\Models\UserModel;

class UserService
{
    protected $userModel;

    public function __construct(UserModel $userModel)
    {
        $this->userModel = $userModel;
    }

    public function authenticate($email, $password)
    {
        $user = $this->userModel->where('email', $email)->first();

        if ($user && !empty($user->password) && password_verify($password, $user->password)) {
            // Autenticação bem-sucedida, você pode retornar o usuário autenticado aqui se desejar
            return $user;
        } else {
            return null;
        }
    }

    public function createUser($userArray)
    {
        $user = new User();

      
        $user->email = $userArray['email'];
        $user->password = password_hash($userArray['password'], PASSWORD_BCRYPT); // Hash da senha

        if ($this->userModel->save($user)) {
            return true;
        } else {
            return false;
        }
    }

    public function selfDelete($id)
    {
        if ($this->userModel->delete($id)) {
            return true;
        } else {
            return false;
        }
    }

    // Novo método para buscar um usuário pelo email
    public function getUserByEmail($email)
    {
        $user = $this->userModel->select('password')->where('email', $email)->first();

        return $user ? $user->password : null;
    }
}
