<?php

namespace App\Services;

use App\Entities\User;
use App\Models\UserModel;
use CodeIgniter\HTTP\Request;

class UserService
{
    protected $userModel;
    protected $request;

    public function __construct(UserModel $userModel)
    {
        $this->userModel = $userModel;
        $this->request = service('request');
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
        $user->password = password_hash($userArray['password'], PASSWORD_BCRYPT);
        $user->birthdate = $userArray['birthdate'];
        $user->mother_name = $userArray['mother_name'];

        $postData = $this->request->getPost();
        var_dump($postData);
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
// teste