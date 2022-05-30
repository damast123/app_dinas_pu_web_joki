<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Kategori Pengaduan</h1>
        <a href="{{url('/admin_pu/kategori_pengaduan/create')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-plus fa-sm text-white-50"></i> Add</a>
    </div>

    <!-- Content Row -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Semua Kategori Pengaduan</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered tableUserAwal" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nama</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>Nama</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($kategori_pengaduan as $kp)
                            <tr>
                                <td>{{$kp->id}}</td>
                                <td>{{$kp->nama}}</td>
                                <td><button onclick="edit('{{$kp->id}}')" class="btn btn-primary btn-circle">
                                    <i class="fas fa-edit"></i>
                                </button><button onclick="destroy('{{$kp->id}}')" class="btn btn-danger btn-circle">
                                    <i class="fas fa-trash"></i>
                                </button></td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Edit User Modal-->
<div id="edit_modal" class="modal animated  fadeInUp" data-backdrop="static" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Kategori pengaduan</h5>
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
                    <form id="form_data" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <input type="text" name="id_edit" id="id_edit" class="form-control" style="display: none">
                        </div>
                        <div class="form-group">
                            <label>Nama kategori:</label>
                            <input type="text" name="kategori_nama" id="kategori_nama_edit" class="form-control" placeholder="Masukkan nama kategori">
                        </div>
                    </form>
                </p>
            </div>
            <div class="modal-footer md-button">
                <button type="button" class="btn btn-danger" id="btn_cancel" onclick="cancel()" style="display:none;"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>&nbsp;Batal</button>
                <button type="button" class="btn btn-warning" id="btn_update" onclick="update()" style="display:none;"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>&nbsp;Update</button>
            </div>
        </div>
    </div>
</div>

<!-- Delete User Modal-->
<div id="delete_modal" class="modal animated  fadeInUp" data-backdrop="static" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete kategori pengaduan</h5>
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
                            <label>Nama kategori:</label>
                            <input type="text" name="nama_kategori" id="nama_kategori_delete" class="form-control" readonly>
                        </div>
                    </form>
                </p>
            </div>
            <div class="modal-footer md-button">
                <button type="button" class="btn btn-warning" id="btn_softdelete" onclick="softdelete()" style="display:none;">Delete</button>
            </div>
        </div>
    </div>
</div>

<script>
    function toEdit() {
        $('#edit_modal').modal('show');
        $('#validation_alert').hide();
        $('#validation_content').html('');
        $('#btn_update').show();
        $('#btn_cancel').show();
        reset();
    }
    function toDelete() {
        $('#delete_modal').modal('show');
        $('#btn_softdelete').show();
        $('#btn_delete').show();
    }

    function edit(id){
        toEdit();
        console.log(id);
        $.ajax({
            url: '{{ url("/admin_pu/kategori_pengaduan/edit") }}',
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
                $('#kategori_nama_edit').val(response.nama);
                $('#id_edit').val(response.id);

                $('#btn_update').attr('onclick', 'update(' + id + ')');
            },
            error: function() {

            }
        });

    }

    function reset() {
        $('#form_data').trigger('reset');
        $('#validation_alert').hide();
        $('#validation_content').html('');
    }

    function success() {
        reset();
        $('#edit_modal').modal('hide');
        location.reload();
    }

    function deletesuccess() {
        $('#delete_modal').modal('hide');
        location.reload();
    }

    function update(id) {
        var data = new FormData($('#form_data')[0]);
        $.ajax({
            url: '{{ url("/admin_pu/kategori_pengaduan/update") }}',
            type: 'POST',
            dataType: 'JSON',
            contentType: false,
            processData: false,
            data: data,
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
                    $('.modal-body').scrollTop(0);
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
            url: '{{ url("/admin_pu/kategori_pengaduan/destroy") }}',
            type: 'POST',
            dataType: 'JSON',
            data: {
                id: id
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {

                $('#nama_kategori_delete').val(response.nama);
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
            url: '{{ url("/admin_pu/kategori_pengaduan/softdelete") }}',
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
