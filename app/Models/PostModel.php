<?php

namespace App\Models;

use App\Entities\Post;
use CodeIgniter\Model;

class PostModel extends Model
{
    // Define o nome da tabela no banco de dados que esta classe representa.
    protected $table = 'posts';

    // Especifica o nome da coluna que serve como chave primária na tabela.
    protected $primaryKey = 'id';

    // Indica se a chave primária deve ser autoincrementada.
    protected $useAutoIncrement = true;

    // Especifica o tipo de entidade a ser retornada pelos métodos de busca.
    protected $returnType = Post::class;

    // Indica se a exclusão suave (soft delete) está ativada.
    protected $useSoftDeletes = false;

    // Protege automaticamente os campos durante operações de insert e update.
    protected $protectFields = true;

    // Define quais campos da tabela podem ser manipulados por métodos como insert e update.
    protected $allowedFields = ['title', 'content', 'tipo_post_id', 'imagem'];

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

    // Método para criar uma nova postagem.
    public function createPost($data)
    {
        if ($this->insert($data)) {
            return $this->insertID();
        } else {
            return false; // Ou outra indicação de falha
        }
    }

    // Método para atualizar uma imagem de postagem.
    public function updateImagePost($data)
    {
        $this->save($data);
    }

    // Método para encontrar postagens por categoria.
    public function findByCategory($category)
    {
        return $this->where('tipo_post_id', $category)->findAll();
    }

    // Método para obter todas as categorias distintas.
    public function getAllCategories()
    {
        $distinctCategories = $this->distinct('tipo_post_id')->findAll();
        $uniqueCategories = array_column($distinctCategories, 'tipo_post_id');
        return $uniqueCategories;
    }

    // Método para obter categorias distintas (versão alternativa).
    public function getDistinctCategories()
    {
        // Aqui você deve implementar a lógica para obter as categorias distintas do banco de dados.
        // Por exemplo, se você está usando o CodeIgniter Query Builder, pode ser algo assim:
        $this->select('tipo_post_id'); // Substitua 'tipo_post_id' pelo nome da coluna real em sua tabela.
        $this->distinct();
        $result = $this->get()->getResultArray();
        $categories = [];
        foreach ($result as $row) {
            $categories[] = $row['tipo_post_id'];
        }
        return $categories;
    }

    // Método para excluir uma postagem pelo ID.
    public function deletePost($postId)
    {
        // Tente excluir a postagem pelo ID
        $this->db->transStart();
        $this->where('id', $postId)->delete();
        $this->db->transComplete();

        // Verifique se a exclusão foi bem-sucedida
        return $this->db->affectedRows() > 0;
    }

    // Método para atualizar uma postagem pelo ID.
    public function updatePost($postId, $data)
    {
        // Tente atualizar a postagem pelo ID
        $this->db->transStart();
        $this->update($postId, $data);
        $this->db->transComplete();

        // Verifique se a atualização foi bem-sucedida
        return $this->db->affectedRows() > 0;
    }
}
?>
