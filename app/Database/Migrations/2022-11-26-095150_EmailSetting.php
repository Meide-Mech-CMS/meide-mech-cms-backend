<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class EmailSetting extends Migration
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
            'main_email' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'email_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'logo' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'thumbnail_logo' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'social_media' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'subject_email' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'body_email_to' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'email_received' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'body_email_received' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'email_cc' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'reply_to_email' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'reply_to_email_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'mail_type' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'protocol' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'host' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'username' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'password' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'port' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'charset' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'timeout' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'validation' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'wordwrap' => [
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
        $this->forge->createTable('email_setting');
    }

    public function down()
    {
        $this->forge->dropTable('email_setting');
    }
}
