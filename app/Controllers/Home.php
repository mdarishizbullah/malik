<?php

namespace App\Controllers;

use App\Models\Room;
use App\Models\OrderRoom;
use Hermawan\DataTables\DataTable;

class Home extends BaseController
{
    protected $roomOrderModel;
    protected $roomModel;

    public function __construct()
    {
        $this->roomOrderModel = new OrderRoom();
        $this->roomModel = new Room();
    }

    public function index()
    {
        $data['rooms'] = $this->roomModel->findAll();
        return view('Home/index', $data);
    }

    public function rooms()
    {
        return view('Home/rooms');
    }

    public function data()
    {
        $orders = $this->roomOrderModel->where('time >=', date('Y-m-d'))
            ->findAll();

        return $this->response->setJSON($orders);
    }

    public function bookRoom()
    {
        $room_id = $this->request->getPost('room_id');
        $time = $this->request->getPost('time');
        $name = $this->request->getPost('name');
        $phone = $this->request->getPost('phone');

        // Validasi data input jika diperlukan
        // ...

        // Lakukan proses booking
        $data = [
            'id_room' => $room_id,
            'customer_name' => $name,
            'customer_contact' => $phone,
            'time' => $time,
            'status' => 1, // Atur status sesuai dengan kebutuhan (contoh: 1 untuk booked)
        ];

        $this->roomOrderModel->insert($data);

        // Kirim respon booking berhasil
        return $this->response->setJSON(['status' => 'success']);
    }

    public function roomOrders()
    {
        return view('Home/room_orders');
    }

    public function roomOrdersData()
    {
        $db = db_connect();
        $builder = $db->table('room_orders')
            ->select('room_orders.id, rooms.room_name, customer_name, customer_contact, time, status.type')
            ->join('rooms', 'rooms.id = room_orders.id_room')->join('status', 'status.id = room_orders.status');

        return DataTable::of($builder)->add('action', function ($row) {
            return '
                   <button type="button" class="btn btn-success btn-sm" data="' . $row->id . '">Settled</button>
                   <button type="button" class="btn btn-danger btn-sm" data="' . $row->id . '">Canceled</button>
               ';
        })->addNumbering('no')->toJson(true);
    }

    public function updateStatus()
    {
        // Get the ID and new status from the AJAX request
        $id = $this->request->getPost('id');
        $newStatus = $this->request->getPost('status'); // You can adjust this based on your needs

        // Update the status in the database using your model
        // Replace 'YourModel' with the actual model class that interacts with the database
        $success =  $this->roomOrderModel->update($id, ['status' => $newStatus]);

        // Prepare the response data to be sent back to the AJAX request
        $response = [
            'success' => $success,
            'message' => $success ? 'Status updated successfully.' : 'Failed to update status.',
        ];

        // Convert the response data to JSON format and send it back
        return $this->response->setJSON($response);
    }

    public function roomsData()
    {
        $db = db_connect();
        $builder = $db->table('rooms')
            ->select('id, room_name, price');

        return DataTable::of($builder)->add('action', function ($row) {
            return '
                   <button type="button" class="btn btn-warning btn-sm" data="' . $row->id . '" data-name="' . $row->room_name . '" data-price="' . $row->price . '">Edit</button>
               ';
        })->addNumbering('no')->toJson(true);
    }

    public function editRoom()
    {
        $id = $this->request->getPost('id');
        $name = $this->request->getPost('name');
        $price = $this->request->getPost('price');

        // Validasi data input jika diperlukan
        // Update the status in the database using your model
        // Replace 'YourModel' with the actual model class that interacts with the database
        $success =  $this->roomModel->update($id, ['room_name' => $name, 'price' => $price]);

        // Prepare the response data to be sent back to the AJAX request
        $response = [
            'success' => $success,
            'message' => $success ? 'Status updated successfully.' : 'Failed to edit room.',
        ];

        // Convert the response data to JSON format and send it back
        return $this->response->setJSON($response);
    }
}
