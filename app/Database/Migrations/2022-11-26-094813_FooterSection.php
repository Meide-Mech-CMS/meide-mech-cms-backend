<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FooterSection extends Migration
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
            'content' => [
                'type'       => 'TEXT',
            ],
            'telp_number' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
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
        $this->forge->createTable('footer_section');
    }

    public function down()
    {
        $this->forge->dropTable('footer_section');
    }
}
