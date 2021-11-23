<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddFluxoestoques extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'entrada_saida'       => [
                'type'       => 'CHAR',
                'constraint' => '1',
            ],
            'quantidade' => [
                'type' => 'DOUBLE',
            ],
            'momento' => [
                'type' => 'DATETIME',
            ],
            'produto_id' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('fluxo_estoque');
        $this->forge->add_field('CONSTRAINT FOREIGN KEY (produto_id) REFERENCES produtos(id)');
    }

    public function down()
    {
        $this->forge->dropTable('fluxo_estoque');
    }
}