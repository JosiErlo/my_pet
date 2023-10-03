<?php

namespace App\Models;

use App\Entities\User;
use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['email', 'password'];
    protected $returnType = User::class;

    protected $validationRules = [
        'email' => 'required|valid_email',
        'password' => 'required|min_length[6]',
    ];

    public function getUser($email)
    {
        return $this->where('email', $email)->first();
    }
    
    public function createUser($email, $hashedPassword)
    {
        $data = [
            'email' => $email,
            'password' => $hashedPassword
        ];

        return $this->insert($data);
    }
    
}
