<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RunSeeder extends Seeder
{
    public function run()
    {
        $this->call('AuthGroups');
        $this->call('Rooms');
        $this->call('Users');
        $this->call('Status');
        $this->call('AuthGroupsUsers');
    }
}
