<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddProdutos extends Migration
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
            'nome'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'descricao' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'valor_custo' => [
                'type' => 'DOUBLE',
                'null' => true,
            ],
            'valor_venda' => [
                'type' => 'DOUBLE',
                'null' => true,
            ],
            'quantidade' => [
                'type' => 'DOUBLE',
                'null' => true,
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
        $this->forge->createTable('produtos');
    }

    public function down()
    {
        $this->forge->dropTable('produtos');
    }
}