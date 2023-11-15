<?php

namespace App\Models;

use CodeIgniter\Model;

class ImagemModel extends Model
{
    protected $table      = 'imagens';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['post_id', 'caminho_imagem'];

    // Adicione métodos específicos, se necessário
}
