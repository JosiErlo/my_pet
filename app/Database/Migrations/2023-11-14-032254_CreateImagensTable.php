<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateImagensTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'post_id' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'caminho_imagem' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
                'default' => null,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('post_id', 'posts', 'id'); // Chave estrangeira referenciando a tabela 'posts'
        $this->forge->createTable('imagens');
    }

    public function down()
    {
        $this->forge->dropTable('imagens');
    }
}
