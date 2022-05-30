<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Role</h1>
        <button onclick="addrole()" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-plus fa-sm text-white-50"></i> Add</button>
    </div>

    <!-- Content Row -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Semua Jenis Role</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered tableUserAwal" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        foreach ($role as $r) {
                            $id = $r['id'];
                            echo "<tr>";
                            echo "<td>".$r['id']."</td>";
                            echo "<td>".$r['nama_role']."</td>";
                            echo '<td>

                                <button class="btn btn-primary btn-circle" onclick="editrole('.$id.')">
                                    <i class="fas fa-edit"></i>
                                </button>

                                </td>';
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


</div>
<div id="add_role" class="modal animated  fadeInUp" data-backdrop="static" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Role</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <div class="modal-body">
                <p class="modal-text">
                    <div class="alert alert-danger" id="validation_alert" role="alert" style="display:none;">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
                        <ul id="validation_content"></ul>
                    </div>
                    <form id="form_data">
                        <div class="form-group" id="id_role" style="display:none;">
                            <label>Id : </label>
                            <input type="text" name="id" id="id" class="form-control" value="" readonly>
                        </div>
                        <div class="form-group">
                            <label>Nama Role :</label>
                            <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan nama role">
                        </div>

                    </form>
                </p>
            </div>
            <div class="modal-footer md-button">
                <button type="button" class="btn btn-info" id="update" onclick="update()" style="display:none;">Update</button>
                <button type="button" class="btn btn-info" id="save" onclick="create()" style="display:none;">Save</button>
                <button type="button" class="btn btn-danger" id="cancel" onclick="cancel()" style="display:none;">Cancel</button>
            </div>
        </div>
    </div>
</div>


<script>
    function toAdd() {
        $('#form_data').trigger('reset');
        $('#add_role').modal('show');
        $('#save').show();
        $('#id_role').hide();
        $('#update').hide();
        $('#cancel').show();
        $('#cancel').show();
    }
    function toEdit() {
        $('#add_role').modal('show');
        $('#update').show();
        $('#save').hide();
        $('#cancel').show();
    }
    function reset() {
        $('#form_data').trigger('reset');
        $('#validation_alert').hide();
        $('#validation_content').html('');
    }
    function cancel() {
        reset();
        $('#form_modal').modal('hide');
    }
    function addrole() {
        toAdd();
    }
    function editrole(id) {
        toEdit();
        $.ajax({
            url: '{{ url("/admin_pu/role/edit") }}',
            type: 'POST',
            dataType: 'JSON',
            data: {
                id: id
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                $('#id_role').show();
                $('#id').val(response.id);
                $('#nama').val(response.nama_role);
                $('#btn_update').attr('onclick', 'update(' + id + ')');
            },
            error: function() {
            }
        });
    }
    function success() {
        reset();
        $('#add_jabatan').modal('hide');
        location.reload();
    }
    function create() {
        $.ajax({
            url: '{{ url("admin_pu/role/store") }}',
            type: 'POST',
            dataType: 'JSON',
            data: $('#form_data').serialize(),

            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            success: function(response) {
                if(response.status == 200) {
                    success();
                } else if(response.status == 422) {
                    notif('Validasi!', '#FFC107');
                    $('#validation_alert').show();
                    $('.modal-body').scrollTop(0);

                    $.each(response.error, function(i, val) {
                        $('#validation_content').append(`
                            <li>` + val + `</li>
                        `);
                    })
                } else {
                    alert(response.message);
                }
            },
            error: function() {
                $('.modal-body').scrollTop(0);
                alert("error");
            }
        });
    }

    function update(id) {
        $.ajax({
            url: '{{ url("admin_pu/role/update") }}',
            type: 'POST',
            dataType: 'JSON',
            data: $('#form_data').serialize(),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if(response.status == 200) {
                    success();
                } else if(response.status == 422) {
                    $('#validation_alert').show();
                    $('.modal-body').scrollTop(0);
                    $.each(response.message, function(i, val) {
                        $('#validation_content').append(`
                            <li>` + val + `</li>
                        `);
                    });
                } else {
                    $('#validation_alert').show();
                    $('#validation_content').append(`<p>`+response.message+`</p>`);
                }
            },
            error: function() {
                $('.modal-body').scrollTop(0);
            }
        });
    }
</script>
