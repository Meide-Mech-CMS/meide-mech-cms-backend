<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AboutUs extends Migration
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
            'title' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'description' => [
                'type'       => 'TEXT',
            ],
            'video' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'other_description' => [
                'type'       => 'TEXT',
                'null' => true,
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
        $this->forge->createTable('about_us');
    }

    public function down()
    {
        $this->forge->dropTable('about_us');
    }
}
