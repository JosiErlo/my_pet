<?php

namespace App\Models;

use CodeIgniter\Model;

class PostModel extends Model
{
    protected $table = 'posts';
    protected $primaryKey = 'id';
    protected $allowedFields = ['title','content','tipo_post_id'];
    
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
   
       $query = $this->db->table('posts');
       $query->select('tipo_post_id'); // Substitua 'tipo_post_id' pelo nome da coluna real em sua tabela.
       $query->distinct();
       $result = $query->get()->getResultArray();
   
       $categories = [];
   
       foreach ($result as $row) {
           $categories[] = $row['tipo_post_id'];
       }
   
       return $categories;
   }
}