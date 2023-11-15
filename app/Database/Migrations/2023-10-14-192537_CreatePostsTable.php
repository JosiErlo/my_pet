<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePostsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'content' => [
                'type' => 'TEXT',
            ],
            'tipo_post_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'imagem' => [ 
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true, 
            ],
        ]);
    
    
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('tipo_post_id', 'categorias', 'id');
        $this->forge->createTable('posts');
    }
    

    public function down()
    {
        $this->forge->dropTable('posts');
    }
}
