<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'full_name'     => 'Administrator',
            'username'     => 'admin',
            'email'     => 'admin@example.com',
            'password' => password_hash('admin', PASSWORD_DEFAULT),
            'uuid'     => rand(10000000, 99999999),
            'is_online'    => 0,
            'status'    => 1,
            'rules'     => 'administrator',
            'images' => 'default.png',
            'thumbnail_images' => 'default.png',
            'createBy' => 'Seeder',
            'updateBy' => 'Seeder',
        ];
        $this->db->table('user')->insert($data);
    }
}