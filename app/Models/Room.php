<?php

namespace App\Models;

use CodeIgniter\Model;

class Room extends Model
{
    protected $table = 'rooms';
    protected $primaryKey = 'id'; // Ganti 'id' dengan primary key tabel rooms
    protected $allowedFields = ['room_name', 'price']; // Sesuaikan dengan nama kolom yang berisi opsi
}
