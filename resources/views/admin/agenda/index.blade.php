<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Agenda</h1>
        <a href="{{url('/admin_pu/agenda/create')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-plus fa-sm text-white-50"></i> Add</a>
    </div>

    <!-- Content Row -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Semua Agenda</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered tableUserAwal" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Event</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Akhir</th>
                            <th>Jam</th>
                            <th>Pembuat Event</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama Event</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Akhir</th>
                            <th>Jam</th>
                            <th>Pembuat Event</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($agenda as $key => $a)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$a->nama_event}}</td>
                                <td>{{$a->tanggal_mulai}}</td>
                                <td>{{$a->tanggal_akhir}}</td>
                                <td>{{$a->jam}}</td>
                                <td>{{$dinas[$key][0]->name}}</td>
                                <td><button onclick="show('{{$a->id}}')" class="btn btn-secondary btn-circle">
                                    <i class="fas fa-eye"></i>
                                </button> <button onclick="edit('{{$a->id}}')" class="btn btn-primary btn-circle">
                                    <i class="fas fa-edit"></i>
                                </button></td>
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
                <h5 class="modal-title">Detail Agenda</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <div class="modal-body">
                <p class="modal-text">
                        <div class="form-group">
                            <label>Nama Event :</label>
                            <span id="nama_event"></span>
                        </div>
                        <p></p>
                        <div class="form-group">
                            <label>Tanggal:</label>
                            <span id="tanggal_mulai"></span> <span> - </span> <span id="tanggal_akhir"></span>
                        </div>
                        <p></p>
                        <div class="form-group">
                            <label>Jam:</label>
                            <span id="jam"></span>
                        </div>
                        <p></p>
                        <div class="form-group">
                            <label>Isi Event:</label>
                            <p id="isi_event"></p>
                        </div>
                        <div class="form-group">
                            <label>Tempat Event:</label>
                            <span id="tempat_event"></span>
                        </div>

                </p>
            </div>

        </div>
    </div>
</div>

<!-- Edit User Modal-->
<div id="edit_modal" class="modal animated  fadeInUp" data-backdrop="static" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Agenda</h5>
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
                        <div class="form-group">
                            <input type="hidden" name="id" id="id_edit" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label>Nama Event:</label>
                            <input type="text" name="nama_event" id="nama_event_edit" class="form-control">
                            @if ($errors->has('nama_event'))
                                <span class="text-danger">{{ $errors->first('nama_event') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <strong>Tanggal Mulai:</strong>
                            <input type="date" name="tanggal_mulai" id="tanggal_mulai_edit" class="form-control">
                            @if ($errors->has('tanggal_mulai'))
                                <span class="text-danger">{{ $errors->first('tanggal_mulai') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Tanggal Akhir:</label>
                            <input type="date" name="tanggal_akhir" id="tanggal_akhir_edit" class="form-control">
                            @if ($errors->has('tanggal_akhir'))
                                <span class="text-danger">{{ $errors->first('tanggal_akhir') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Jam:</label>
                            <input type="time" name="jam" id="jam_edit" class="form-control">
                            @if ($errors->has('jam'))
                                <span class="text-danger">{{ $errors->first('jam') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Isi Event:</label>
                            <textarea name="isi_event" id="isi_event_edit" class="form-control" rows="3"></textarea>
                            @if ($errors->has('isi_event'))
                                <span class="text-danger">{{ $errors->first('isi_event') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Tempat Event:</label>
                            <input type="text" name="tempat_event" id="tempat_event_edit" class="form-control">
                            @if ($errors->has('tempat_event'))
                                <span class="text-danger">{{ $errors->first('tempat_event') }}</span>
                            @endif
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

<script>
    function toEdit() {
        $('#edit_modal').modal('show');
        $('#validation_alert').hide();
        $('#validation_content').html('');
        $('#btn_update').show();
        $('#btn_cancel').show();
    }
    function toShow() {
        $('#show_modal').modal('show');
        $('#validation_alert').hide();
        $('#validation_content').html('');
    }
    function edit(id){
        toEdit();
        console.log(id);
        $.ajax({
            url: '{{ url("/admin_pu/agenda/edit") }}',
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
                $('#nama_event_edit').val(response.nama_event);
                $('#tanggal_mulai_edit').val(response.tanggal_mulai);
                $('#tanggal_akhir_edit').val(response.tanggal_akhir);
                $('#jam_edit').val(response.jam);
                $('#isi_event_edit').val(response.isi_event);
                $('#tempat_event_edit').val(response.tempat_event);
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
            url: '{{ url("/admin_pu/agenda/update") }}',
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

    function show(id){
        toShow();
        console.log(id);
        $.ajax({
            url: '{{ url("/admin_pu/agenda/show") }}',
            type: 'POST',
            dataType: 'JSON',
            data: {
                id: id
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {

                $('#id_agenda').html(response.id);
                $('#nama_event').html(response.nama_event);
                $('#tanggal_mulai').html(response.tanggal_mulai);
                $('#tanggal_akhir').html(response.tanggal_akhir);
                $('#jam').html(response.jam);
                $('#isi_event').html(response.isi_event);
                $('#tempat_event').html(response.tempat_event);
            },
            error: function() {

            }
        });
    }
</script>
