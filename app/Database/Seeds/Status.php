<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Status extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id'          => 1,
                'type'        => 'Unpaid',
            ],
            [
                'id'          => 2,
                'type'        => 'Settled',
            ],
            [
                'id'          => 3,
                'type'        => 'Canceled',
            ],
        ];
        $this->db->table('status')->insertBatch($data);
    }
}
