<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ServiceFeatureImages extends Migration
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
            'service_feature_id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
            ],
            'images' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'status' => [
                'type'       => 'BOOLEAN',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('service_feature_id', 'service_feature', 'id');
        $this->forge->createTable('service_feature_images');
    }

    public function down()
    {
        $this->forge->dropTable('service_feature_images');
    }
}