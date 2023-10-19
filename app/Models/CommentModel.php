<?php

namespace App\Models;

use CodeIgniter\Model;

class CommentModel extends Model
{
    protected $table = 'comments';
    protected $primaryKey = 'id';
    protected $allowedFields = ['post_id', 'content', 'user_id', 'created_at'];

    public function addComment($commentText, $userID, $postID)
    {
        $data = [
            'content' => $commentText,
            'created_at' => date('Y-m-d H:i:s'),
            'user_id' => $userID,
            'post_id' => $postID,
        ];

        return $this->insert($data);
    }

    public function viewComments($postID)
    {
        $query = $this->where('post_id', $postID)->findAll();

        if ($query) {
            return $query;
        } else {
            return array(); // ou outra ação apropriada se não houver comentários
        }
    }
}
