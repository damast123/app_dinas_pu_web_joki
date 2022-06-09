<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
</head>

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Surat Perintah</h1>
        <a href="{{url('/admin_pu/surat_perintah/create')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-plus fa-sm text-white-50"></i> Add</a>
    </div>

    <!-- Content Row -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Semua Surat Perintah</h6>
            @if(Session::has('success'))
                <div class="alert alert-success">
                {{ Session::get('success') }}
                    @php
                        Session::forget('success');
                    @endphp
                </div>
            @elseif (Session::has('error'))
                <div class="alert alert-danger">
                {{ Session::get('error') }}
                    @php
                        Session::forget('error');
                    @endphp
                </div>
            @endif
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered tableUserAwal" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No Surat Perintah</th>
                            <th>Pegawai Dinas Pembuat</th>
                            <th>Pegawai Dinas Tujuan</th>
                            <th>File</th>
                            <th>Gambar</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No Surat Perintah</th>
                            <th>Pegawai Dinas Pembuat</th>
                            <th>Pegawai Dinas Tujuan</th>
                            <th>File</th>
                            <th>Gambar</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($surat_perintah as $key => $sp)
                            <tr>
                                <td>{{$sp->no_surat_perintah}}</td>
                                <td>{{$pegawai_dinas_pembuat[$key][0]->name}}</td>
                                <td>{{$pegawai_dinas_tujuan[$key][0]->name}}</td>
                                @if (file_exists(public_path('/doc_surat_perintah/'.$sp->file)))
                                <td><a href="/admin_pu/surat_perintah/download/{{$sp->file}}">{{$sp->file}}</a></td>
                                @else
                                <td>No File</td>
                                @endif
                                @if (file_exists(public_path('/gambar_surat_perintah/'.$sp->gambar)))
                                <td><a href="{{ url('/gambar_surat_perintah/'.$sp->gambar) }}"><img src="{{ url('/gambar_surat_perintah/'.$sp->gambar) }}" alt="..." class="d-block img-fluid" height="100" width="100"></a></td>
                                @else
                                <td><img src="https://cdn.bodybigsize.com/wp-content/uploads/2020/03/noimage-15.png" alt="..." class="d-block img-fluid" height="100" width="100"></td>
                                @endif

                                <td><button onclick="show('{{$sp->id}}')" class="btn btn-secondary btn-circle">
                                    <i class="fas fa-eye"></i>
                                </button>
                                @if ($sp->status === 0)
                                    <button onclick="edit('{{$sp->id}}')" class="btn btn-primary btn-circle">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button onclick="destroy('{{$sp->id}}')" class="btn btn-danger btn-circle">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                @else
                                    <button onclick="edit('{{$sp->id}}')" style="display: none" class="btn btn-primary btn-circle">
                                        <i class="fas fa-edit"></i>
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
                <h5 class="modal-title">Perintah Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <div class="modal-body">

                <div class="tabbable">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab1" data-toggle="tab">Detail surat perintah</a></li>
                        <li><p style="color: white">Ini</p></li>
                        <li><a href="#tab2" data-toggle="tab">Detail pengaduan</a></li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="tab1">
                            <p class="modal-text">
                                <label>No Surat Perintah :</label>
                                <span id="no_surat_perintah"></span>
                                <br>
                                <label>Tanggal Surat Perintah Keluar:</label>
                                <span id="tanggal"></span>
                                <br>
                                <label>Lokasi:</label>
                                <span id="lokasi"></span>
                                <br>
                                <label>Pesan:</label>
                                <span id="pesan"></span>
                                <br>
                                <label>Laporan:</label>
                                <span id="laporan"></span>
                                <br>
                                <label>Status:</label>
                                <span id="status"></span>
                            </p>
                        </div>
                        <div class="tab-pane" id="tab2">
                            <p class="modal-text">
                                <label>Tanggal Kejadian:</label>
                                <span id="tanggal_kejadian"></span>
                                <br>
                                <label>Tanggal Pengaduan:</label>
                                <span id="tanggal_pengaduan"></span>
                                <br>
                                <label>Judul:</label>
                                <span id="judul_pengaduan"></span>
                                <br>
                                <label>Isi Pesan:</label>
                                <span id="pesan_pengaduan"></span>
                                <br>
                                <label>Jenis Pengaduan:</label>
                                <span id="jenis_pengaduan"></span>
                                <br>
                                <label>Nama Pengadu:</label>
                                <span id="nama_pengadu"></span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit User Modal-->
<div id="edit_modal" class="modal animated  fadeInUp" data-backdrop="static" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Perintah</h5>
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
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        <div class="form-group">
                            <input type="text" name="id" id="id_edit" class="form-control" style="display: none" readonly>
                        </div>
                        <div class="form-group">
                            <label>No Surat Perintah :</label>
                            <input type="text" name="no_surat_perintah" id="no_surat_perintah_edit" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label>Tanggal:</label>
                            <input type="text" name="tanggal" id="tanggal_edit" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label>Lokasi:</label>
                            <input type="text" name="lokasi" id="lokasi_edit" class="form-control" placeholder="Masukkan lokasi" readonly>
                        </div>
                        <div class="form-group">
                            <label>Pesan:</label>
                            <input type="text" name="pesan" id="pesan_edit" class="form-control" placeholder="Masukkan pesan">
                        </div>
                        <div class="form-group">
                            <label>Laporan:</label>
                            <input type="text" name="laporan" id="laporan_edit" class="form-control" placeholder="Masukkan laporan">
                        </div>
                        <div class="form-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="gambar_edit" id="gambar_edit">
                                <label class="custom-file-label" for="gambar" id="label_gambar_edit">Pilih Gambar</label>
                            </div>

                        </div>
                        <div class="form-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="file_doc_edit" id="file_doc_edit">
                                <label class="custom-file-label" for="file_doc" id="label_doc_edit">Pilih file doc</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Status:</label>
                            <select class="form-control" name="status_laporan_edit" id="status_laporan_edit">
                                <option value="0">Pending</option>
                                <option value="1">Done</option>
                                <option value="2">Cancel</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <input type="text" name="dinas_pembuat" id="dinas_pembuat_edit" class="form-control" style="display: none">
                        </div>
                        <div class="form-group">
                            <input type="text" name="dinas_tujuan" id="dinas_tujuan_edit" class="form-control" style="display: none">
                        </div>
                    </form>
                </p>
            </div>
            <div class="modal-footer md-button">
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
                <h5 class="modal-title">Delete Perintah</h5>
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
                            <label>No Surat Perintah:</label>
                            <input type="text" name="no_surat_perintah" id="no_surat_perintah_delete" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label>Pesan:</label>
                            <input type="text" name="pesan" id="pesan_delete" class="form-control" readonly>
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
    $('#tab_id').trigger('click');
</script>

<script>
    function toEdit() {
        $('#edit_modal').modal('show');
        $('#validation_alert').hide();
        $('#validation_content').html('');
        $('#btn_update').show();
        $('#btn_cancel').show();
    }
    function toDelete() {
        $('#delete_modal').modal('show');
        $('#btn_softdelete').show();
        $('#btn_delete').show();
    }
    function toShow() {
        $('#show_modal').modal('show');
        $('#validation_alert').hide();
        $('#validation_content').html('');
    }
    function edit(id){
        toEdit();

        $.ajax({
            url: '{{ url("/admin_pu/surat_perintah/edit") }}',
            type: 'POST',
            dataType: 'JSON',
            data: {
                id: id
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                $('#no_surat_perintah_edit').val(response.no_surat_perintah);
                $('#tanggal_edit').val(response.tanggal);
                $('#lokasi_edit').val(response.lokasi);
                $('#pesan_edit').val(response.pesan);
                $('#laporan_edit').val(response.laporan);
                $('#id_edit').val(response.id);
                $('#dinas_pembuat_edit').val(response.pegawai_dinas_pembuat);
                $('#dinas_tujuan_edit').val(response.pegawai_dinas_tujuan);

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
            url: '{{ url("/admin_pu/surat_perintah/update") }}',
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

    function show(id){
        toShow();
        $.ajax({
            url: '{{ url("/admin_pu/surat_perintah/show") }}',
            type: 'POST',
            dataType: 'JSON',
            data: {
                id: id
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                console.log(response[0]);
                $('#no_surat_perintah').html(response[0].no_surat_perintah);
                $('#tanggal').html(response[0].tanggal);
                $('#lokasi').html(response[0].lokasi);
                $('#pesan').html(response[0].pesan);
                $('#laporan').html(response[0].laporan);
                $('#nama_pengadu').html(response[0].nama_rakyat);
                $('#jenis_pengaduan').html(response[0].jenis_pengaduan);
                $('#tanggal_pengaduan').html(response[0].tanggal_pengaduan);
                $('#pesan_pengaduan').html(response[0].pesan);
                $('#judul_pengaduan').html(response[0].judul_pengaduan);
                $('#tanggal_kejadian').html(response[0].tanggal_kejadian);
                if(response[0].status==0)
                {
                    $('#status').html("Pending");
                }
                else if(response[0].status==1)
                {
                    $('#status').html("Done");
                }
                else
                {
                    $('#status').html("Cancel");
                }

            },
            error: function() {

            }
        });
    }

    function destroy(id) {
        toDelete();
        $.ajax({
            url: '{{ url("/admin_pu/surat_perintah/destroy") }}',
            type: 'POST',
            dataType: 'JSON',
            data: {
                id: id
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {

                $('#pesan_delete').val(response.pesan);
                $('#no_surat_perintah_delete').val(response.no_surat_perintah);
                $('#id_delete').val(response.id);
                $('#btn_softdelete').attr('onclick', 'softdelete(' + id + ')');
            },
            error: function() {

            }
        });
    }
    function softdelete(id) {
        $.ajax({
            url: '{{ url("/admin_pu/surat_perintah/softdelete") }}',
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
