<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProductDimension extends Migration
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
            'product_id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
            ],
            'inch' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'mm' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'kgs' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'pcs_or_csn' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'ctn_qty_or_plt' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'crate_or_plt_qty_20_container' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('product_id', 'product', 'id');
        $this->forge->createTable('product_dimension');
    }

    public function down()
    {
        $this->forge->dropTable('product_dimension');
    }
}