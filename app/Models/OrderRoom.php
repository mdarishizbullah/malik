<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderRoom extends Model
{
    protected $table = 'room_orders';
    protected $primaryKey = 'id'; // Ganti 'id' dengan primary key tabel room_orders
    protected $allowedFields = ['id_room', 'customer_name', 'customer_contact', 'time', 'status']; // Sesuaikan dengan nama kolom yang berisi opsi

    public function roomOrderName()
    {
        // Implement your custom query here
        // For example, you can use the Query Builder to build your custom query
        $query = $this->db->query('SELECT a.id, b.room_name, a.customer_name, a.customer_contact, a.time, a.status FROM room_orders AS a JOIN rooms AS b ON a.id_room = b.id ORDER BY a.id DESC');

        return $query->getResult(); // Return the result of the query
    }
}
