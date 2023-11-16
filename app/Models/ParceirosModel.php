<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\Parceiro;

class Parceiros extends Model
{
    // Define o grupo de conexão do banco de dados.
    protected $DBGroup = 'default';

    // Define o nome da tabela no banco de dados que esta classe representa.
    protected $table = 'parceiros';

    // Especifica o nome da coluna que serve como chave primária na tabela.
    protected $primaryKey = 'id';

    // Indica se a chave primária deve ser autoincrementada.
    protected $useAutoIncrement = true;

    // Especifica o tipo de retorno dos resultados das consultas.
    protected $returnType = 'array';

    // Indica se a exclusão suave (soft delete) está ativada.
    protected $useSoftDeletes = false;

    // Protege automaticamente os campos durante operações de insert e update.
    protected $protectFields = true;

    // Define quais campos da tabela podem ser manipulados por métodos como insert e update.
    // Neste caso, a propriedade está vazia, o que significa que todos os campos são permitidos.

    protected $allowedFields = [];

    // Dates
    // Indica se a tabela contém campos de data.
    protected $useTimestamps = false;

    // Define o formato de data para campos de data.
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation
    // Define regras de validação para os campos da tabela.
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    // Define se os callbacks estão habilitados e quais métodos devem ser chamados em diferentes eventos.
    protected $allowCallbacks = true;
    protected $beforeInsert = [];
    protected $afterInsert = [];
    protected $beforeUpdate = [];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];
}
?>
