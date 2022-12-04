<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class HeaderSection extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'icon' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'title' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'description' => [
                'type'       => 'TEXT',
            ],
            'status' => [
                'type'       => 'BOOLEAN',
            ],
            'createDate' => [
                'type'       => 'DATETIME',
            ],
            'createBy' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'updateDate' => [
                'type'       => 'DATETIME',
            ],
            'updateBy' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('header_section');
    }

    public function down()
    {
        $this->forge->dropTable('header_section');
    }
}
