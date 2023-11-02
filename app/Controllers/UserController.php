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
            $data['users'] = $this->userModel->findAll();
            return view('user/index', $data);
        }
        public function create()
        {
            return view('user/create');
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

        public function delete($id)
        {
            $this->userModel->delete($id);
            return redirect()->to('/user');
        }
    }
