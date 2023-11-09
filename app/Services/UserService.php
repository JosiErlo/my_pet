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
        return $this->userModel->where('email', $email)->first();
    }

    public function deleteUser($id)
    {
        // Recupere o usuário com base no ID
        $user = $this->userModel->find($id);

        if ($user) {
            // Realize a lógica de exclusão, por exemplo:
            if ($this->userModel->delete($id)) {
                return true;
            } else {
                // Lidar com erros, se a exclusão falhar
                return false;
            }
        } else {
            // Lidar com o caso em que o usuário não foi encontrado
            return false;
        }
    }
}
