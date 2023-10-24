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
}
