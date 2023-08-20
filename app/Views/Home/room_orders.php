<?= view('App\Views\Auth\_header') ?>
<?= view('App\Views\Auth\_message_block') ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <!-- Your card header content goes here -->
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="table">
                        <thead class="thead-inverse">
                            <tr>
                                <th>No</th>
                                <th>Room</th>
                                <th>Name</th>
                                <th>Contact</th>
                                <th>Time</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->section('script') ?>
<script>
    $(document).ready(function() {
        $('#table').DataTable({
            processing: true,
            serverSide: true,
            autoWidth: false,
            ajax: '<?= base_url('room_orders/alldata') ?>',
            order: [],
            dom: 'Bfrtip',
            buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],
            columns: [{
                    data: 'no',
                    orderable: false
                }, {
                    data: 'room_name'
                },
                {
                    data: 'customer_name'
                },
                {
                    data: 'customer_contact'
                },
                {
                    data: 'time'
                },
                {
                    data: 'type'
                },
                {
                    data: 'action'
                }
            ]
        });
        $("body").on("click", "button.btn-success", function() {
            var dataValue = $(this).attr('data');
            $.ajax({
                url: '<?= base_url('room_orders/status') ?>', // Replace with your backend route to handle status update
                method: 'POST',
                data: {
                    id: dataValue,
                    status: 2,
                },
                dataType: 'json',
                success: function(response) {
                    // Handle the server response here (if needed)
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Updated',
                            text: 'Payment has been settled.',
                        });
                        // Update the status text on the table
                        // Reload the table after successful update
                        $('#table').DataTable().ajax.reload(); // Replace 'table' with your table ID or class
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Failed',
                            text: 'Status update failed.',
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Failed to update status. Check the AJAX request.',
                    });
                }
            });
        }).on("click", "button.btn-danger", function() {
            var dataValue = $(this).attr('data');
            $.ajax({
                url: '<?= base_url('room_orders/status') ?>', // Replace with your backend route to handle status update
                method: 'POST',
                data: {
                    id: dataValue,
                    status: 3,
                },
                dataType: 'json',
                success: function(response) {
                    // Handle the server response here (if needed)
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Updated',
                            text: 'The order has been canceled',
                        });
                        // Update the status text on the table
                        // Reload the table after successful update
                        $('#table').DataTable().ajax.reload(); // Replace 'table' with your table ID or class
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Failed',
                            text: 'Status update failed.',
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Failed to update status. Check the AJAX request.',
                    });
                }
            });
        });
    });
</script>
<?= $this->endSection() ?>
<?= view('App\Views\Auth\_footer') ?>