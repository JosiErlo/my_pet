<?php

namespace App\Models;

use App\Entities\Comment; // Importa a classe Comment do namespace App\Entities
use CodeIgniter\Model;

class CommentModel extends Model
{
    // Define o nome da tabela no banco de dados que esta classe representa.
    protected $table = 'comments';

    // Especifica o nome da coluna que serve como chave primária na tabela.
    protected $primaryKey = 'id';

    // Define quais campos da tabela podem ser manipulados por métodos como insert e update.
    // Neste caso, os campos 'post_id', 'content' e 'user_id' estão permitidos.
    protected $allowedFields = ['post_id', 'content', 'user_id'];

    // Especifica o tipo de entidade a ser retornada pelos métodos de busca.
    // Neste caso, o tipo de entidade é a classe Comment.
    protected $returnType = Comment::class;
}
?>
