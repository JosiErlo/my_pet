<?php

namespace App\Models;

use CodeIgniter\Model;

class ImagemModel extends Model
{
    // Define o nome da tabela no banco de dados que esta classe representa.
    protected $table = 'imagens';

    // Especifica o nome da coluna que serve como chave primária na tabela.
    protected $primaryKey = 'id';

    // Indica se a chave primária deve ser autoincrementada.
    protected $useAutoIncrement = true;

    // Define quais campos da tabela podem ser manipulados por métodos como insert e update.
    // Neste caso, os campos 'post_id' e 'caminho_imagem' estão permitidos.
    protected $allowedFields = ['post_id', 'caminho_imagem'];

    // Adicione métodos específicos, se necessário
}
?>
