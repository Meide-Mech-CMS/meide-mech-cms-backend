<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Carousel extends Migration
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
            'images' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'thumbnail_images' => [
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
            'link' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
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
        $this->forge->createTable('carousel');
    }

    public function down()
    {
        $this->forge->dropTable('carousel');
    }
}
