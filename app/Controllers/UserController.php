<?php

    namespace App\Controllers;

    use App\Models\UserModel;
    use CodeIgniter\Controller;

    class UserController extends BaseController
    {
        protected $userModel;

        public function __construct()
        {
            $this->userModel = new UserModel();
        }

        public function index()
    {
        // Obtém o nome do usuário da sessão
        $userName = session()->get('user_name');

        // Passa o nome do usuário para a visão
        $data['userName'] = $userName;

        return view('user/index', $data);
    }
    
        public function store()
        {
            $data = [
                'email' => $this->request->getPost('email'),
                'password' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
                'birthdate' => $this->request->getPost('birthdate'),
            ];

            if ($this->userModel->insert($data)) {
                return redirect()->to('/user');
            } else {
                $data['errors'] = $this->userModel->getErrors();
                return view('user/create', $data);
            }
        }

        public function edit($id)
        {
            $data['user'] = $this->userModel->find($id);
            return view('user/edit', $data);
        }

        public function update($id)
        {
            $data = [
                'email' => $this->request->getPost('email'),
                'password' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
                'birthdate' => $this->request->getPost('birthdate'),
            ];

            if ($this->userModel->update($id, $data)) {
                return redirect()->to('/user');
            } else {
                $data['errors'] = $this->userModel->getErrors();
                return view('user/edit', $data);
            }
        }

    //   
    public function delete($id)
    {
        // Verifique se o usuário está autenticado
        if (session()->get('loggedin')) {
            // Exclua o usuário com base no ID
            $this->userModel->delete($id);
    
            // Não exclua os comentários e posts associados ao usuário, apenas o usuário em si
    
            // Faça o logout
            session()->destroy();
    
            return redirect()->to('/');
        } else {
            // Lidar com erros, se a exclusão falhar
            return 'Erro ao excluir a conta';
        }
    }
    


}
