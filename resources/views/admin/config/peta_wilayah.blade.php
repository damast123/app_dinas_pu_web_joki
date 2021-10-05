<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Peta Wilayah</h1>
        <button onclick="addpetawilayah()" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-plus fa-sm text-white-50"></i> Add</button>
    </div>

    <!-- Content Row -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Semua Peta Wilayah</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered tableUserAwal" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>File</th>
                            <th>Gambar</th>
                            <th>Dinas Yang Mengupload</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>File</th>
                            <th>Gambar</th>
                            <th>Dinas Yang Mengupload</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($petawilayah as $key => $pw)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$pw->file}}</td>
                                <td>{{$pw->gambar}}</td>
                                <td>{{$dinas[$key]->name}}</td>
                                <td><button onclick="showPetaWilayah('{{$pw->id}}')" class="btn btn-secondary btn-circle">
                                    <i class="fas fa-eye"></i></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


</div>

<div id="add_peta_wilayah" class="modal animated  fadeInUp" data-backdrop="static" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Peta Wilayah</h5>
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
                    <form method="post" id="form_data" enctype="multipart/form-data">
                        <div class="form-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="gambar" id="gambar">
                                <label class="custom-file-label" for="gambar">Pilih gambar</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="file_doc" id="file_doc">
                                <label class="custom-file-label" for="file_doc">Pilih file</label>
                            </div>
                        </div>
                    </form>
                </p>
            </div>
            <div class="modal-footer md-button">
                <button type="button" class="btn btn-danger" id="cancel" onclick="cancel()" style="display:none;">Cancel</button>
                <button type="button" class="btn btn-info" id="add" onclick="create()" style="display:none;">Add</button>
            </div>
        </div>
    </div>
</div>

<div id="show_peta_wilayah" class="modal animated  fadeInUp" data-backdrop="static" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Peta Wilayah</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <div class="modal-body">
                <p class="modal-text">
                    <img src="" id="preview_gambar">
                    <a href="">download_doc</a>
                </p>
            </div>
            <div class="modal-footer md-button">
                <button type="button" class="btn btn-danger" id="cancel" onclick="cancel()" style="display:none;">Cancel</button>
            </div>
        </div>
    </div>
</div>


<script>
    function toShow() {
        $('#show_peta_wilayah').modal('show');
        $('#cancel').show();
    }

    function addpetawilayah() {
        $('#form_data').trigger('reset');
        $('#add_peta_wilayah').modal('show');
        $('#add').show();
        $('#cancel').show();
    }

    function reset() {
        $('#form_data').trigger('reset');
        $('#show_peta_wilayah').modal('hide');
        $('#add_peta_wilayah').modal('hide');
        $('#validation_alert').hide();
        $('#validation_content').html('');
    }
    function cancel() {
        reset();
    }
    function showPetaWilayah(id) {
        toShow();
        $.ajax({
            url: '{{ url("/admin_pu/peta_wilayah/show") }}',
            type: 'POST',
            dataType: 'JSON',
            data: {
                id: id
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                $('#preview_gambar').attr('src', "{{ url('/profile/') }}".response.gambar);
                $('#download_doc').attr('href', '');
            },
            error: function() {
            }
        });
    }
    function success() {
        reset();
        location.reload();
    }
    function create() {
        var postData = new FormData($("#form_data")[0]);
        $.ajax({
            url: '{{ url("/admin_pu/peta_wilayah/store") }}',
            type: 'POST',
            dataType: 'JSON',
            data: postData,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            success: function(response) {
                console.log(response.status);
                console.log(response);
                if(response.status == 200) {
                    success();
                } else if(response.status == 422) {
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

</script>
