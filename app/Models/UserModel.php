<?php

namespace App\Models;

use App\Entities\User;
use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users'; // O nome da tabela de banco de dados associada a esta classe.
    protected $primaryKey = 'id'; // A chave primária da tabela.
    protected $allowedFields = ['email', 'password']; // Campos permitidos para inserção/edição.
    protected $returnType = User::class; // O tipo de retorno para os resultados da consulta.

    protected $validationRules = [
        'email' => 'required|valid_email',
        'password' => 'required|min_length[6]',
    ];

    // Método para acessar os erros de validação
    public function getErrors()
    {
        return $this->errors();
    }

    public function getUser($email)
    {
        return $this->where('email', $email)->first(); // Obtém um usuário com base no endereço de e-mail.
    }

    public function createUser($email, $hashedPassword)
    {
        $data = [
            'email' => $email,
            'password' => $hashedPassword
        ];

        return $this->insert($data); // Insere um novo usuário no banco de dados.
    }
}
