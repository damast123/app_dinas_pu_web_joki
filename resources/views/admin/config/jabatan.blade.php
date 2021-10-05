<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Jabatan</h1>
        <button onclick="addjabatan()" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-plus fa-sm text-white-50"></i> Add</button>
    </div>

    <!-- Content Row -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Semua Jenis Jabatan</h6>
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
                        foreach ($jabatan as $j) {
                            $id = $j['id'];
                            echo "<tr>";
                            echo "<td>".$j['id']."</td>";
                            echo "<td>".$j['nama_jabatan']."</td>";
                            echo '<td>

                                <button class="btn btn-primary btn-circle" onclick="editjabatan('.$id.')">
                                    <i class="fas fa-edit"></i>
                                </button>

                                <button class="btn btn-danger btn-circle" onclick="destroy('.$id.')">
                                    <i class="fas fa-trash"></i>
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

<div id="add_jabatan" class="modal animated  fadeInUp" data-backdrop="static" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Jabatan</h5>
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
                        <div class="form-group" id="id_jabatan" style="display:none;">
                            <label>Id : </label>
                            <input type="text" name="id" id="id" class="form-control" value="" readonly>
                        </div>
                        <div class="form-group">
                            <label>Nama Jabatan :</label>
                            <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan nama jabatan">
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

<!-- Delete User Modal-->
<div id="delete_modal" class="modal animated  fadeInUp" data-backdrop="static" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Jabatan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <div class="modal-body">
                <p class="modal-text">
                    <p>Are you sure want to delete this?</p>
                    <form id="form_data">
                        <div class="form-group">
                            <input type="hidden" name="id" id="id_delete" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label>Nama Jabatan:</label>
                            <input type="text" id="nama_jabatan_delete" class="form-control" readonly>
                        </div>
                    </form>
                </p>
            </div>
            <div class="modal-footer md-button">
                <button type="button" class="btn btn-warning" id="btn_softdelete" onclick="softdelete()" style="display:none;">Soft Delete</button>
                <button type="button" class="btn btn-danger" id="btn_delete" onclick="harddelete()" style="display:none;">Delete Pemanent</button>
            </div>
        </div>
    </div>
</div>

<script>
    function toAdd() {
        $('#form_data').trigger('reset');
        $('#add_jabatan').modal('show');
        $('#save').show();
        $('#id_jabatan').hide();
        $('#update').hide();
        $('#cancel').show();
        $('#cancel').show();
    }
    function toEdit() {
        $('#add_jabatan').modal('show');
        $('#update').show();
        $('#save').hide();
        $('#cancel').show();
    }
    function reset() {
        $('#form_data').trigger('reset');
        $('#validation_alert').hide();
        $('#validation_content').html('');
    }
    function toDelete() {
        $('#delete_modal').modal('show');
        $('#btn_softdelete').show();
        $('#btn_delete').show();
    }
    function cancel() {
        reset();
        $('#form_modal').modal('hide');
    }
    function deletesuccess() {
        $('#delete_modal').modal('hide');
        location.reload();
    }
    function addjabatan() {
        toAdd();
    }
    function editjabatan(id) {
        toEdit();
        $.ajax({
            url: '{{ url("/admin_pu/jabatan/edit") }}',
            type: 'POST',
            dataType: 'JSON',
            data: {
                id: id
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                $('#id_jabatan').show();
                $('#id').val(response.id);
                $('#nama').val(response.nama_jabatan);
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
            url: '{{ url("admin_pu/jabatan/store") }}',
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
            url: '{{ url("admin_pu/jabatan/update") }}',
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

    function destroy(id) {
        toDelete();
        $.ajax({
            url: '{{ url("/admin_pu/jabatan/destroy") }}',
            type: 'POST',
            dataType: 'JSON',
            data: {
                id: id
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {

                $('#nama_jabatan_delete').val(response.nama_jabatan);
                $('#id_delete').val(response.id);
                $('#btn_softdelete').attr('onclick', 'softdelete(' + id + ')');
                $('#btn_delete').attr('onclick', 'harddelete(' + id + ')');
            },
            error: function() {

            }
        });
    }

    function softdelete(id) {
        $.ajax({
            url: '{{ url("/admin_pu/jabatan/softdelete") }}',
            type: 'POST',
            dataType: 'JSON',
            data: {
                id: id
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if(response.status == 200) {
                    deletesuccess();
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

    function harddelete(id) {
        $.ajax({
            url: '{{ url("/admin_pu/jabatan/harddelete") }}',
            type: 'POST',
            dataType: 'JSON',
            data: {
                id: id
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if(response.status == 200) {
                    deletesuccess();
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
