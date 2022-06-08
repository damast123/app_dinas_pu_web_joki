<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">User Dinas</h1>
    </div>

    <!-- Content Row -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Semua User Dinas</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered tableUserAwal" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Role</th>
                            <th>Jabatan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Role</th>
                            <th>Jabatan</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($dinas as $key => $d)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$d->name}}</td>
                                <td>{{$role[$key]->nama_role}}</td>
                                <td>{{$jabatan[$key]->nama_jabatan}}</td>
                                <td>
                                    @if ($rolesaatini == null)
                                        <button onclick="show({{$d->id}})" class="btn btn-secondary btn-circle">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    @else
                                        <button onclick="show({{$d->id}})" class="btn btn-secondary btn-circle">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button onclick="editdinas({{$d->id}})" class="btn btn-primary btn-circle">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button onclick="destroy({{$d->id}})" class="btn btn-danger btn-circle">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



<!-- Show User Modal-->
<div id="show_modal" class="modal animated  fadeInUp" data-backdrop="static" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Dinas Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <div class="modal-body">
                <p class="modal-text">
                        <label>Name :</label>
                        <span id="name"></span>
                        <br>
                        <label>Alamat :</label>
                        <span id="alamat"></span>
                        <br>
                        <label>Tanggal lahir:</label>
                        <span id="tanggal_lahir"></span>
                        <br>
                        <label>Tempat lahir:</label>
                        <span id="tempat_lahir"></span>
                        <br>
                        <label>No telepon:</label>
                        <span id="no_telp"></span>
                        <br>
                        <label>Email:</label>
                        <span id="email"></span>
                </p>
            </div>
        </div>
    </div>
</div>

<!-- edit dinas modal -->
<div id="edit_modal" class="modal animated  fadeInUp" data-backdrop="static" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="alert alert-danger" style="display:none"></div>
            <div class="modal-header">
                <h5 class="modal-title">Dinas Edit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <div class="modal-body">
                <p class="modal-text">

                    <form method="POST" id="form_data">
                        <div class="form-group" id="id_role" style="display:none;">
                            <input type="hidden" name="id" id="id_edit" class="form-control" value="" readonly>
                        </div>
                        <div class="form-group">
                            <label>Nama : <span style="color: red">*</span></label>
                            <input name="name" id="name_edit" class="form-control" placeholder="Masukkan nama" />
                        </div>
                        <div class="form-group">
                            <label>Alamat :</label>
                            <input name="alamat" id="alamat_edit" class="form-control" placeholder="Masukkan alamat" />
                        </div>
                        <div class="form-group">
                            <label>Tanggal lahir:</label>
                            <input type="date" name="tanggal_lahir" id="tanggal_lahir_edit" class="form-control" placeholder="Masukkan tanggal lahir" />
                        </div>
                        <div class="form-group">
                            <label>Tempat lahir:</label>
                            <input name="tempat_lahir" id="tempat_lahir_edit" class="form-control" placeholder="Masukkan tempat lahir" />
                        </div>
                        <div class="form-group">
                            <label>No telepon: <span style="color: red">*</span></label>
                            <input name="no_telp" id="no_telp_edit" class="form-control" placeholder="Masukkan nomor telephone" />
                        </div>
                        <div class="form-group">
                            <label>Email: <span style="color: red">*</span></label>
                            <input name="email" id="email_edit" class="form-control" placeholder="Masukkan email" />
                        </div>
                        <div class="form-group">
                            <select class="form-control" id="role" name="role">
                                <option value="">--Pilih Role--</option>
                                @foreach ($input_role as $r)
                                    <option value="{{ $r->id }}">{{ $r->nama_role }}</option>
                                @endforeach
                            </select>
                            <small id="catatan_role" class="form-text text-muted">Bila tidak ingin diganti, maka bisa dibiarkan saja</small>
                        </div>
                        <div class="form-group">
                            <select class="form-control" id="jabatan" name="jabatan">
                                <option value="">--Pilih Jabatan--</option>
                                @foreach ($input_jabatan as $j)
                                    <option value="{{ $j->id }}">{{ $j->nama_jabatan }}</option>
                                @endforeach
                            </select>
                            <small id="jabatan_role" class="form-text text-muted">Bila tidak ingin diganti, maka bisa dibiarkan saja</small>
                        </div>

                        <div class="modal-footer md-button">
                            <button type="button" class="btn btn-info" id="save" onclick="save()" style="display:none;">Save</button>
                        </div>
                    </form>
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Delete dinas Modal-->
<div id="delete_modal" class="modal animated  fadeInUp" data-backdrop="static" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete dinas</h5>
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
                        <label>Name :</label>
                        <span id="name_delete"></span>
                        <br>
                        <label>Alamat :</label>
                        <span id="alamat_delete"></span>
                        <br>
                        <label>Tanggal lahir:</label>
                        <span id="tanggal_lahir_delete"></span>
                        <br>
                        <label>Tempat lahir:</label>
                        <span id="tempat_lahir_delete"></span>
                        <br>
                        <label>No telepon:</label>
                        <span id="no_telp_delete"></span>
                        <br>
                        <label>Email:</label>
                        <span id="email_delete"></span>
                    </form>
                </p>
            </div>
            <div class="modal-footer md-button">
                <button type="button" class="btn btn-danger" id="btn_delete" onclick="softdelete()" style="display:none;">Delete</button>
            </div>
        </div>
    </div>
</div>

<script>

    function toShow() {
        $('#show_modal').modal('show');
        $('#validation_alert').hide();
        $('#validation_content').html('');
    }

    function toEdit() {
        $('.alert-danger').hide();
        $('#edit_modal').modal('show');
        $('#save').show();
        $("#form_data")[0].reset();
    }

    function toDelete() {
        $('#delete_modal').modal('show');
        $('#btn_delete').show();
    }

    function success() {
        $('#edit_modal').modal('hide');
        location.reload();
    }

    function deletesuccess() {
        $('#delete_modal').modal('hide');
        location.reload();
    }

    function show(id){
        toShow();
        $.ajax({
            url: '{{ url("/admin_pu/dinas/show") }}',
            type: 'POST',
            dataType: 'JSON',
            data: {
                id: id
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                $('#name').html(response.name);
                $('#alamat').html(response.alamat);
                $('#tempat_lahir').html(response.tempat_lahir);
                $('#tanggal_lahir').html(response.tanggal_lahir);
                $('#no_telp').html(response.no_telp);
                $('#email').html(response.email);
            },
            error: function() {

            }
        });
    }

    function editdinas(id) {
        toEdit();
        $.ajax({
            url: '{{ url("/admin_pu/dinas/edit") }}',
            type: 'POST',
            dataType: 'JSON',
            data: {
                id: id
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                console.log(response);
                $('#id_jabatan').show();

                $('#id_edit').val(response[0].id);
                $('#name_edit').val(response[0].name);
                $('#alamat_edit').val(response[0].alamat);
                $('#tempat_lahir_edit').val(response[0].tempat_lahir);
                $('#tanggal_lahir_edit').val(response[0].tanggal_lahir);
                $('#no_telp_edit').val(response[0].no_telp);
                $('#email_edit').val(response[0].email);

                $('#save').attr('onclick', 'update(' + id + ')');
            },
            error: function() {
            }
        });
    }

    function update(id) {
        $.ajax({
            url: '{{ url("admin_pu/dinas/update") }}',
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
                    $('.alert-danger').show();
                    $('.modal-body').scrollTop(0);
                    $.each(response.message, function(i, val) {
                        $('.alert-danger').append(`
                            <li>` + val + `</li>
                        `);
                    });
                } else {
                    $('#.alert-danger').show();
                    $('#.alert-danger').append(`<p>`+response.message+`</p>`);
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
            url: '{{ url("/admin_pu/dinas/destroy") }}',
            type: 'POST',
            dataType: 'JSON',
            data: {
                id: id
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                $('#id_delete').val(response.id);
                $('#name_delete').html(response.name);
                $('#alamat_delete').html(response.alamat);
                $('#tempat_lahir_delete').html(response.tempat_lahir);
                $('#tanggal_lahir_delete').html(response.tanggal_lahir);
                $('#no_telp_delete').html(response.no_telp);
                $('#email_delete').html(response.email);

                $('#btn_delete').attr('onclick', 'softdelete(' + id + ')');
            },
            error: function() {

            }
        });
    }

    function softdelete(id) {
        $.ajax({
            url: '{{ url("/admin_pu/dinas/softdelete") }}',
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
