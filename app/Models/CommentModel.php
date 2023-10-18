<?php

namespace App\Models;

use CodeIgniter\Model;

class CommentModel extends Model
{
    protected $table = 'comments';
    protected $primaryKey = 'id';
    protected $allowedFields = ['post_id', 'content', 'user_id', 'created_at'];

    public function addComment($postID, $commentText, $userID)
    {
        $data = [
            'post_id' => $postID,
            'content' => $commentText,
            'user_id' => $userID,
            'created_at' => date('Y-m-d H:i:s'),
        ];

        return $this->insert($data);
    }

    public function viewComments($postID)
    {
        return $this->where('post_id', $postID)->findAll();
    }
}
