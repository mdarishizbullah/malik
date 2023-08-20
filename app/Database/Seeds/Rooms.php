<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Rooms extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id'            => 1,
                'room_name'     => 'Malik Room',
                'price'         => '100000',
            ],
            [
                'id'            => 2,
                'room_name'     => 'Fadhul Room',
                'price'         => '50000',
            ],
            [
                'id'            => 3,
                'room_name'     => 'Ahmad Room',
                'price'         => '150000',
            ],

        ];
        $this->db->table('rooms')->insertBatch($data);
    }
}
