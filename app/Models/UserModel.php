<?php

namespace App\Models;

use App\Entities\User;
use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['email', 'password', 'birthdate', 'mother_name']; // Adicione 'mother_name' aqui
    protected $returnType = User::class;

    protected $validationRules = [
        'email' => 'required|valid_email',
        'password' => 'required|min_length[6]',
        'mother_name' => 'required',
    ];

    // Método para acessar os erros de validação
    public function getErrors()
    {
        return $this->errors();
    }

    public function getUser($email)
    {
        return $this->where('email', $email)->first();
    }

    public function createUser($email, $hashedPassword, $birthdate, $motherName)
    {
        $data = [
            'email' => $email,
            'password' => $hashedPassword,
            'birthdate' => $birthdate,
            'mother_name' => $motherName, // Adicione 'mother_name' aqui
        ];

        return $this->insert($data);
    }
}
