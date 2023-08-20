<?php

namespace App\Database\Seeds;

use Myth\Auth\Password;
use CodeIgniter\Database\Seeder;

class Users extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id'            => 1,
                'email'         => 'superuser@gmail.com',
                'username'      => 'superuser',
                'password_hash' => Password::hash('09120912'),
                'active'        => 1,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'id'            => 2,
                'email'         => 'manager@gmail.com',
                'username'      => 'manager',
                'password_hash' => Password::hash('09120912'),
                'active'        => 1,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'id'            => 3,
                'email'         => 'admin@gmail.com',
                'username'      => 'admin',
                'password_hash' => Password::hash('09120912'),
                'active'        => 1,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            // Add more users as needed
        ];
        // Insert the data into the "users" table
        $this->db->table('users')->insertBatch($data);
    }
}
