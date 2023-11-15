<?php

namespace App\Models;

use App\Entities\Post;
use CodeIgniter\Model;

class PostModel extends Model
{
    protected $table = 'posts';
    protected $primaryKey = 'id';
    protected $returnType = Post::class;
    protected $allowedFields = ['title', 'content', 'tipo_post_id'];

    public function createPost($data)
    {
        if ($this->insert($data)) {
            return $this->insertID();
        } else {
            return false; // Ou outra indicação de falha
        }
    }

    public function updateImagePost($data){
     
        $this->save($data);
    }
    public function findByCategory($category)

    {
        return $this->where('tipo_post_id', $category)->findAll();
    }

    public function getAllCategories()
    {
        $distinctCategories = $this->distinct('tipo_post_id')->findAll();

        $uniqueCategories = array_column($distinctCategories, 'tipo_post_id');

        return $uniqueCategories;
 
   }
  
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
   public function deletePost($postId)
{
    // Tente excluir a postagem pelo ID
    $this->db->transStart();
    $this->where('id', $postId)->delete();
    $this->db->transComplete();

    // Verifique se a exclusão foi bem-sucedida
    return $this->db->affectedRows() > 0;
}

}