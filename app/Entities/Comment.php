<?php

// Importa o namespace necessário para a entidade Comment
namespace App\Entities;

// Importa a classe Entity do CodeIgniter
use CodeIgniter\Entity\Entity;

// A classe Comment é uma entidade que representa um comentário no sistema
class Comment extends Entity
{
    // Define um mapeamento personalizado de dados (datamap)
    protected $datamap = [];

    // Define os campos de data que podem ser tratados como objetos DateTime
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];

    // Define as conversões de tipo para atributos específicos, se necessário
    protected $casts   = [];
}
