<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AuthGroups extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id'          => 1,
                'name'        => 'superuser',
                'description' => 'Superuser',
            ],
            [
                'id'          => 2,
                'name'        => 'manager',
                'description' => 'For Limers and Managers',
            ],
            [
                'id'          => 3,
                'name'        => 'admin',
                'description' => 'Room guard',
            ],
            [
                'id'          => 99,
                'name'        => 'guest',
                'description' => 'New User',
            ],
        ];
        $this->db->table('auth_groups')->insertBatch($data);
    }
}
