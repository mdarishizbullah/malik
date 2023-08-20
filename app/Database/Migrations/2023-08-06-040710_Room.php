<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Room extends Migration
{
    public function up()
    {
        // rooms
        $this->forge->addField([
            'id'            => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'room_name'     => ['type' => 'varchar', 'constraint' => 255],
            'price'         => ['type' => 'varchar', 'constraint' => 255],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('room_name');

        $this->forge->createTable('rooms', true);

        // Order Room
        $this->forge->addField([
            'id'         => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'id_room'    => ['type' => 'int', 'constraint' => 11],
            'customer_name'   => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
            'customer_contact' => ['type' => 'varchar', 'constraint' => 20, 'null' => true],
            'time'       => ['type' => 'varchar', 'constraint' => 10, 'null' => true],
            'status'     => ['type' => 'tinyint', 'constraint' => 1],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('room_orders', true);

        // Status
        $this->forge->addField([
            'id'         => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'type'    => ['type' => 'varchar', 'constraint' => 255]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('status', true);
    }

    //--------------------------------------------------------------------

    public function down()
    {

        $this->forge->dropTable('users', true);
        $this->forge->dropTable('room_orders', true);
        $this->forge->dropTable('status', true);
    }
}
