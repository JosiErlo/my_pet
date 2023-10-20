<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCategoriasTable extends Migration
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
            'nome' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('categorias');

        // Inserir dados iniciais na tabela de categorias
        $data = [
            ['nome' => 'Cachorro'],
            ['nome' => 'Gato'],
            ['nome' => 'Peixe'],
            ['nome' => 'Pássaros'],
            ['nome' => 'Diversos'],
        ];
        
        $this->db->table('categorias')->insertBatch($data);
    }
    public function down()
     {
        $this->forge->dropTable('categorias');
    }
}
