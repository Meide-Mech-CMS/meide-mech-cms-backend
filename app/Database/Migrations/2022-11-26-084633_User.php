<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class User extends Migration
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
            'full_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'username' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'password' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'uuid' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'last_login' => [
                'type'       => 'TIMESTAMP',
                'null' => true
            ],
            'last_login_ip' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null' => true
            ],
            'last_login_agent' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null' => true
            ],
            'browser_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null' => true
            ],
            'is_online' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null' => true
            ],
            'status' => [
                'type'       => 'BOOLEAN',
            ],
            'rules' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
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
        $this->forge->createTable('user');
    }

    public function down()
    {
        $this->forge->dropTable('user');
    }
}