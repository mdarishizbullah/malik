<?= view('App\Views\Auth\_header') ?>
<?= view('App\Views\Auth\_message_block') ?>
<div style="display: flex; justify-content: center; align-items: center; height: 80vh;">
    <div class="container">
        <div class="card">
            <h5 class="card-header text-center">Check Room Availability</h5>
            <div class="card-body">
                <form>
                    <div class="form-group">
                        <label for="selectOption">Select room</label>
                        <select class="form-control " style=" text-align: center;" id="selectOption">
                            <?php foreach ($rooms as $room) : ?>
                                <option value="<?= $room['id']; ?>"><?= $room['room_name']; ?></option>
                            <?php endforeach; ?>
                        </select>

                    </div>

                    <div class="form-group">
                        <label for="datepicker">Select Date</label>
                        <input type="date" class="form-control" style="text-align: center;" id="datepicker" min="<?php echo date('Y-m-d'); ?>">
                    </div>
                    <div style="text-align: center;">
                        <button type="button" class="btn btn-primary">Check Availability</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->section('script') ?>
<script>
    $(document).ready(function() {
        var selectedOption = $("#selectOption").val();
        var selectedDate = $("#datepicker").val();
        $("body").on("click", ".btn-primary", function() {
            $.getJSON("<?= base_url('room_orders/data'); ?>", function(data) {
                var selectedOption = $("#selectOption").val();
                var selectedDate = $("#datepicker").val();
                if (!selectedDate) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: 'Please select a date in advance.',
                    });
                    return;
                }
                var available = true;
                $.each(data, function(index, room) {
                    if (room.id_room == selectedOption && room.time == selectedDate && room.status == 2) {
                        available = false;
                        return false; // Keluar dari loop jika ditemukan kecocokan
                    }
                });
                if (available) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Available Room',
                        text: 'Please enter your name and mobile number to book.',
                        html: `
                            <div class="form-group">
                                <label for="name">Full Name:</label>
                                <input type="text" class="form-control" id="name" required>
                            </div>
                            <div class="form-group">
                                <label for="phone">Mobile Number:</label>
                                <input type="text" class="form-control" id="phone" required>
                            </div>
                        `,
                        showCancelButton: true,
                        confirmButtonText: 'Book Now',
                        cancelButtonText: 'Close',
                        preConfirm: () => {
                            const name = Swal.getPopup().querySelector('#name').value;
                            const phone = Swal.getPopup().querySelector('#phone').value;
                            if (!name || !phone) {
                                Swal.showValidationMessage('Please fill in all fields.');
                            }
                            return {
                                name: name,
                                phone: phone
                            };
                        },
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Lakukan proses booking dengan nama dan nomor HP yang diisi
                            bookRoom(selectedOption, selectedDate, result.value.name, result.value.phone);
                        }
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Room Not Available',
                        text: 'The room is not available on that date.',
                    });
                }
            });
        })
    });

    function bookRoom(room_id, selectedDate, name, phone) {
        $.post("<?= base_url('room_orders/book_room'); ?>", {
                room_id: room_id,
                time: selectedDate,
                name: name,
                phone: phone
            })
            .done(function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Booking Successful',
                    text: 'The room was successfully booked. Contact us to make 08156090346 payment. Thanks!',
                });
            })
            .fail(function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Failed to book the room.',
                });
            });
    }
</script>
<?= $this->endSection() ?>
<?= view('App\Views\Auth\_footer') ?>