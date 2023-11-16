<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class UserController extends BaseController
{
    protected $userModel;

    // Construtor que inicializa o modelo de usuário
    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    // Método para exibir a página principal do usuário
    public function index()
    {
        // Obtém o nome do usuário da sessão
        $userName = session()->get('user_name');

        // Passa o nome do usuário para a visão
        $data['userName'] = $userName;

        return view('user/index', $data);
    }
    
    // Método para armazenar um novo usuário no banco de dados
    public function store()
    {
        $data = [
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
            'birthdate' => $this->request->getPost('birthdate'),
        ];

        // Insere o novo usuário no banco de dados
        if ($this->userModel->insert($data)) {
            return redirect()->to('/user');
        } else {
            // Se houver erros, passa os erros para a visão
            $data['errors'] = $this->userModel->getErrors();
            return view('user/create', $data);
        }
    }

    // Método para exibir o formulário de edição de usuário
    public function edit($id)
    {
        // Obtém os dados do usuário com base no ID
        $data['user'] = $this->userModel->find($id);
        return view('user/edit', $data);
    }

    // Método para atualizar os dados do usuário no banco de dados
    public function update($id)
    {
        $data = [
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
            'birthdate' => $this->request->getPost('birthdate'),
        ];

        // Atualiza os dados do usuário no banco de dados
        if ($this->userModel->update($id, $data)) {
            return redirect()->to('/user');
        } else {
            // Se houver erros, passa os erros para a visão
            $data['errors'] = $this->userModel->getErrors();
            return view('user/edit', $data);
        }
    }

    // Método para excluir um usuário e fazer o logout
    public function delete($id)
    {
        // Verifique se o usuário está autenticado
        if (session()->get('loggedin')) {
            // Exclua o usuário com base no ID
            $this->userModel->delete($id);
    
            
    
            // Faça o logout
            session()->destroy();
    
            return redirect()->to('/');
        } else {
            // Lidar com erros, se a exclusão falhar
            return 'Erro ao excluir a conta';
        }
    }
}
