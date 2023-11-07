<?php

namespace App\Models;

use App\Entities\User;
use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['email', 'password', 'birthdate', 'mother_name'];
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

    public function updatePassword($userId, $newPassword)
    {
        $data = [
            'password' => $newPassword,
        ];
    
        return $this->update($userId, $data);
    }
    
}
