<?php 
namespace App\Models;

use CodeIgniter\Model;

class CategoriaModel extends Model
{
    // Define o nome da tabela no banco de dados que esta classe representa.
    protected $table = 'categorias';

    // Especifica o nome da coluna que serve como chave primária na tabela.
    protected $primaryKey = 'id';

    // Define quais campos da tabela podem ser manipulados por métodos como insert e update.
    // Neste caso, apenas o campo 'nome' está permitido.
    protected $allowedFields = ['nome'];
}
?>
