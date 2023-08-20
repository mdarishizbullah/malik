<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AuthGroupsUsers extends Seeder
{
    public function run()
    {
        $data = [
            [
                'group_id'      => 1,
                'user_id'      => 1,
            ],
            [
                'group_id'      => 2,
                'user_id'      => 2,
            ],
            [
                'group_id'      => 3,
                'user_id'      => 3,
            ],
        ];

        $this->db->table('auth_groups_users')->insertBatch($data);
    }
}
