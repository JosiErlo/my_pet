<?php

namespace App\Services;

use App\Entities\User;
use App\Models\UserModel;
use CodeIgniter\HTTP\Request;

class UserService
{
    protected $userModel;
    protected $request;

    // Construtor da classe UserService, recebe uma instância de UserModel e Request.
    public function __construct(UserModel $userModel)
    {
        $this->userModel = $userModel;
        $this->request = service('request');
    }

    // Método para autenticar um usuário com base no email e senha.
    public function authenticate($email, $password)
    {
        // Busca o usuário pelo email.
        $user = $this->userModel->where('email', $email)->first();

        // Verifica se o usuário foi encontrado e se a senha está correta.
        if ($user && !empty($user->password) && password_verify($password, $user->password)) {
            // Autenticação bem-sucedida, você pode retornar o usuário autenticado aqui se desejar.
            return $user;
        } else {
            return null;
        }
    }

    // Método para criar um novo usuário.
    public function createUser($userArray)
    {
        // Cria uma instância da entidade User.
        $user = new User();

        // Preenche os dados do usuário a partir do array fornecido.
        $user->email = $userArray['email'];
        $user->password = password_hash($userArray['password'], PASSWORD_BCRYPT);
        $user->birthdate = $userArray['birthdate'];
        $user->mother_name = $userArray['mother_name'];

        // Obtém os dados do formulário usando o serviço Request.
        $postData = $this->request->getPost();
        var_dump($postData);

        // Salva o usuário no banco de dados usando o método save do modelo UserModel.
        if ($this->userModel->save($user)) {
            return true;
        } else {
            return false;
        }
    }

    // Método para excluir um usuário pelo ID.
    public function selfDelete($id)
    {
        // Exclui o usuário do banco de dados usando o método delete do modelo UserModel.
        if ($this->userModel->delete($id)) {
            return true;
        } else {
            return false;
        }
    }

    // Método para buscar um usuário pelo email.
    public function getUserByEmail($email)
    {
        // Busca o usuário pelo email usando o método where do modelo UserModel.
        return $this->userModel->where('email', $email)->first();
    }

    // Método para excluir um usuário pelo ID (com lógica adicional).
    public function deleteUser($id)
    {
        // Recupera o usuário com base no ID.
        $user = $this->userModel->find($id);

        // Verifica se o usuário foi encontrado.
        if ($user) {
            // Realiza a lógica de exclusão, por exemplo:
            if ($this->userModel->delete($id)) {
                return true;
            } else {
                // Lidar com erros, se a exclusão falhar.
                return false;
            }
        } else {
            // Lidar com o caso em que o usuário não foi encontrado.
            return false;
        }
    }
}
