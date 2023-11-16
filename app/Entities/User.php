<?php

namespace App\Models;

use App\Entities\User;
use CodeIgniter\Model;

class UserModel extends Model
{
    // Define o nome da tabela no banco de dados que esta classe representa.
    protected $table = 'users';

    // Especifica o nome da coluna que serve como chave primária na tabela.
    protected $primaryKey = 'id';

    // Define quais campos da tabela podem ser manipulados por métodos como insert e update.
    protected $allowedFields = ['email', 'password', 'birthdate', 'mother_name'];

    // Especifica o tipo de entidade a ser retornada pelos métodos de busca.
    protected $returnType = User::class;

    // Regras de validação para os campos.
    protected $validationRules = [
        'email' => 'required|valid_email',
        'password' => 'required|min_length[6]',
        'mother_name' => 'required',
    ];

    // Método para acessar os erros de validação.
    public function getErrors()
    {
        return $this->errors();
    }

    // Método para atualizar a senha de um usuário.
    public function updatePassword($userId, $newPassword)
    {
        $data = [
            'password' => $newPassword,
        ];
    
        return $this->update($userId, $data);
    }

    // Método para obter informações de um usuário pelo ID.
    public function getUserById($id)
    {
        return $this->find($id);
    }
}
?>
