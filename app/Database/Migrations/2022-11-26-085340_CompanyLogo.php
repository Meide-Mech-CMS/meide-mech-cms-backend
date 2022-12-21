<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CompanyLogo extends Migration
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
            'createBy' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'createDate' => [
                'type'       => 'DATETIME',
            ],
            'updateBy' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'updateDate' => [
                'type'       => 'DATETIME',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('company_logo');
    }

    public function down()
    {
        $this->forge->dropTable('company_logo');
    }
}