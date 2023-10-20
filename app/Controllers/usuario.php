<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use app\Models\UserModel;

class Usuarios extends BaseController
{
    protected $_modelUser;
    protected $session;
    // Validações do formulário
    protected $validationRules = [
        'nome' => 'required|alpha_space|min_length[3]|max_length[50]',
        'senha' => 'required|min_length[6]|max_length[255]',
        'confirmar_senha' => 'required|matches[senha]',
        'email' => 'required|valid_email|is_unique[usuario.email]|max_length[100]',
        'cpf' => 'required|is_unique[usuario.cpf]|exact_length[14]',
        'numero' => 'required|is_unique[usuario.numero]',
        'data_nascimento' => 'required',
        'genero_id' => 'required'
    ];

    public function __construct()
    {
        $this->_modelUser = new UserModel();
        helper('aux');
    }

    public function index()
    {
        return view('user_login');
    }

    public function adicionar()
    {
        return view('user_adicionar');
    }

    public function add()
    {
        $validation = \Config\Services::validation();
    
        $validation->setRules($this->validationRules);
    
        if ($this->request->getMethod() === 'post' && $validation->withRequest($this->request)->run()) {
    
            $senha = $this->request->getPost('senha');
    
            $data = [
                'nome' => $this->request->getPost('nome'),
                'senha' => password_hash($senha, PASSWORD_DEFAULT), // Hash da senha
                'email' => $this->request->getPost('email'),
                'cpf' => $this->request->getPost('cpf'),
                'numero' => $this->request->getPost('numero'),
                'data_nascimento' => $this->request->getPost('data_nascimento'),
                'genero_id' => $this->request->getPost('genero_id'), 
     
            ];
     

            $this->_modelUser->insert($data);
            session()->setFlashdata('message', 'Cadastro adicionado com sucesso');
            return redirect()->to('usuarios');
        } else {
            session()->setFlashdata('message', 'Erro ao tentar registrar, verifique os campos');
            return redirect()->to('usuarios/adicionar');
        }
    }
    

 
    public function login()
    {
       
        // Valide os campos do formulário (nome de usuário e senha)
        $nome = $this->request->getPost('nome');
        $senha = $this->request->getPost('senha');

        // Verifique as credenciais do usuário no banco de dados (ou onde quer que você armazene as informações do usuário)
        $user = $this->_modelUser->authenticate($nome, $senha);
 
        if ($user) {
            // Define as informações do usuário na sessão
            $user_data = [
                'user_id' => $user->id,
                'nome' => $user->nome,
                'data_login' => br2bd(date('Y-m-d')),
                'isLoggedIn' => true, 
            ];

        session()->set($user_data,);

            // Redirecione para a página de perfil ou outra página autorizada
            return redirect()->to('modulo');
        } else {
            session()->setFlashdata('errologin', 'Erro ao tentar logar! Verifique suas credenciais');
            return redirect()->to('usuarios');
        }
    }



    public function logout()
    {
        // Este método é usado para fazer logout do usuário
        session()->destroy();
        return redirect()->to('/');
    }
    
    
    public function ver() {

            return view('usuario_ver');
  
    }
        
    
}