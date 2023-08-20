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
                                <th>Name</th>
                                <th>Price</th>
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
            ajax: '<?= base_url('rooms/data') ?>',
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
                    data: 'price'
                },
                {
                    data: 'action'
                }
            ]
        });
        $("body").on("click", "button.btn-warning", function() {
            var id = $(this).attr('data');
            var name = $(this).attr('data-name');
            var price = $(this).attr('data-price');
            Swal.fire({
                icon: 'warning',
                title: 'Edit Room ' + name,
                text: 'please do it carefully.',
                html: `
                            <div class="form-group">
                                <label for="name">Room Name:</label>
                                <input type="text" class="form-control" id="name${id}" value="${name}" required>
                            </div>
                            <div class="form-group">
                                <label for="price">Price:</label>
                                <input type="number" step="10000" min="0"class="form-control" id="price${id}" value="${price}" required>
                            </div>
                        `,
                showCancelButton: true,
                confirmButtonText: 'Save',
                cancelButtonText: 'Close',
                preConfirm: () => {
                    const name = Swal.getPopup().querySelector('#name' + id).value;
                    const price = Swal.getPopup().querySelector('#price' + id).value;
                    if (!name || !price) {
                        Swal.showValidationMessage('Please fill in all fields.');
                    }
                    return {
                        name: name,
                        price: price,
                    };
                },
            }).then((result) => {
                if (result.isConfirmed) {
                    // Lakukan proses booking dengan nama dan nomor HP yang diisi
                    editRoom(id, result.value.name, result.value.price);
                }
            });
        });
    });

    function editRoom(id, name, price) {
        $.post("<?= base_url('rooms/edit'); ?>", {
                id: id,
                name: name,
                price: price
            })
            .done(function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Edit Room Successful',
                    text: 'Edit room Successful. Thanks!',
                });
                $('#table').DataTable().ajax.reload(); // Replace 'table' with your table ID or class
            })
            .fail(function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Failed to edit the room.',
                });
            });
    }
</script>
<?= $this->endSection() ?>
<?= view('App\Views\Auth\_footer') ?>