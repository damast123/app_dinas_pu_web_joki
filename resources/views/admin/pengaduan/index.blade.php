<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Pengaduan</h1>
    </div>

    <!-- Content Row -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Semua Pengaduan Masyarakat</h6>
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
                            <th>Tanggal Pengaduan</th>
                            <th>Judul Pengaduan</th>
                            <th>Nama</th>
                            <th>Jenis</th>
                            <th>File</th>
                            <th>Gambar</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Tanggal Pengaduan</th>
                            <th>Judul Pengaduan</th>
                            <th>Nama</th>
                            <th>Jenis</th>
                            <th>File</th>
                            <th>Gambar</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($pengaduan as $key => $p)
                            <tr>
                                <td>{{$p->tanggal_pengaduan}}</td>
                                <td>{{$p->judul_pengaduan}}</td>
                                <td>{{$rakyat[$key]->name}}</td>
                                <td>{{$p->jenis_pengaduan}}</td>
                                @if (file_exists(public_path('/docpengaduan/'.$p->file)))
                                <td><a href="/admin_pu/pengaduan/download/{{$p->file}}">{{$p->file}}</a></td>
                                @else
                                <td>No File</td>
                                @endif
                                @if (file_exists(public_path('/gambarpengaduan/'.$p->gambar)))
                                <td><a href="{{ url('/gambarpengaduan/'.$p->gambar) }}"><img src="{{ url('/gambarpengaduan/'.$p->gambar) }}" alt="..." class="d-block img-fluid" height="400" width="400"></a></td>
                                @else
                                <td><img src="https://cdn.bodybigsize.com/wp-content/uploads/2020/03/noimage-15.png" alt="..." class="d-block img-fluid" height="400" width="400"></td>
                                @endif

                                @if ($p->jenis_pengaduan=="pengaduan")
                                    @if ($p->status_pengaduan==0)
                                        <td>Menunggu</td>
                                    @elseif ($p->status_pengaduan==1)
                                        <td>Proses</td>
                                    @elseif ($p->status_pengaduan==2)
                                        <td>Selesai</td>
                                    @else
                                        <td>Tidak di acc</td>
                                    @endif
                                @else
                                    <td>-</td>
                                @endif

                                <td><button onclick="show('{{$p->id}}')" class="btn btn-secondary btn-circle">
                                    <i class="fas fa-eye"></i>
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
                <h5 class="modal-title">Edit Pengaduan</h5>
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
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label>Id :</label>
                            <input type="text" name="id" id="id_edit" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label>Jenis Pengaduan :</label>
                            <input type="text" name="jenis_pengaduan" id="jenis_pengaduan_edit" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Pengaduan :</label>
                            <input type="text" name="tanggal_pengaduan" id="tanggal_pengaduan_edit" class="form-control" readonly>
                        </div>

                        <div class="form-group">
                            <label>Judul Pengaduan :</label>
                            <input type="text" name="judul_pengaduan" id="judul_pengaduan_edit" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label>Isi Pengaduan :</label>
                            <textarea name="isi_pengaduan" id="isi_pengaduan_edit" class="form-control" readonly></textarea>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Kejadian :</label>
                            <input type="text" name="tanggal_kejadian" id="tanggal_kejadian_edit" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label>Lokasi Kejadian :</label>
                            <textarea name="lokasi_pengaduan" id="lokasi_pengaduan_edit" class="form-control" readonly></textarea>
                        </div>

                        <div id="text_status" style="display: none" class="form-group">
                            <label>Status Pengaduan :</label>
                            <input type="text" name="hasil_status" id="hasil_status" class="form-control" readonly>
                        </div>

                        <div id="hide_select" style="display: none" class="form-group">
                            <label>Status Pengaduan :</label>
                            <select name="status_pengaduan" id="status_pengaduan_edit">
                                <option value="">--Pilih Status Pengaduan --</option>
                                <option value="1">Proses</option>
                                <option value="2">Selesai</option>
                                <option value="3">Tidak di acc</option>
                            </select>
                        </div>

                </p>
            </div>
            <div class="modal-footer md-button">
                <button type="button" class="btn btn-danger" id="btn_cancel" onclick="cancel()" style="display:none;"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>&nbsp;Batal</button>
                <button type="button" class="btn btn-warning" id="btn_update" onclick="update()" style="display:none;"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>&nbsp;Update</button>
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
    }

    function show(id){
        var that = this;
        toEdit();
        console.log(id);
        $.ajax({
            url: '{{ url("/admin_pu/pengaduan/show") }}',
            type: 'POST',
            dataType: 'JSON',
            data: {
                id: id
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {

                $('#id_edit').val(response.id);
                $('#jenis_pengaduan_edit').val(response.jenis_pengaduan);
                $('#tanggal_pengaduan_edit').val(response.tanggal_pengaduan);
                $('#isi_pengaduan_edit').val(response.isi_pengaduan);
                $('#judul_pengaduan_edit').val(response.judul_pengaduan);
                $('#tanggal_kejadian_edit').val(response.tanggal_kejadian);
                $('#lokasi_pengaduan_edit').val(response.lokasi_pengaduan);
                console.log(response);
                if(response.jenis_pengaduan=='pengaduan')
                {
                    if (response.status_pengaduan==0||response.status_pengaduan==1) {
                        $('#hide_select').css('display','block');
                    }
                    else
                    {
                        $('#btn_update').hide();
                        $('#btn_cancel').hide();
                        $('#text_status').css('display','block');
                        $('#hide_select').css('display','none');
                        if(response.status_pengaduan==2)
                        {

                            $('#hasil_status').val("Selesai");
                        }
                        else
                        {
                            $('#hasil_status').val("Tidak di acc");
                        }

                    }
                }
                else{
                    $('#btn_update').hide();
                    $('#btn_cancel').hide();
                    $('#text_status').css('display','none');
                    $('#hide_select').css('display','none');
                }



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

    function update(id) {
        $.ajax({
            cache: false,
            url: '{{ url("/admin_pu/pengaduan/update") }}',
            type: 'POST',
            dataType: 'JSON',
            data: {
                id: id,
                status_pengaduan: $("#status_pengaduan_edit").val(),
            },
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
            error: function(jqXHR, exception) {
                var msg = '';
                if (jqXHR.status === 0) {
                    msg = 'Not connect.\n Verify Network.';
                } else if (jqXHR.status == 404) {
                    msg = 'Requested page not found. [404]';
                } else if (jqXHR.status == 500) {
                    msg = 'Internal Server Error [500].';
                } else if (exception === 'parsererror') {
                    msg = 'Requested JSON parse failed.';
                } else if (exception === 'timeout') {
                    msg = 'Time out error.';
                } else if (exception === 'abort') {
                    msg = 'Ajax request aborted.';
                } else {
                    msg = 'Uncaught Error.\n' + jqXHR.responseText;
                }
                console.log("error ini mah... "+msg);
                $('.modal-body').scrollTop(0);
            }
        });
    }
</script>
