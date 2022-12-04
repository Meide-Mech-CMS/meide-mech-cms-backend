<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class NewsletterSubscribe extends Migration
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
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'ip_address' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'browser' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('newsletter_subscribe');
    }

    public function down()
    {
        $this->forge->dropTable('newsletter_subscribe');
    }
}
