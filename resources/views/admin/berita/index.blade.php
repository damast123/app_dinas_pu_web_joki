<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Berita</h1>
        <a href="{{url('/admin_pu/berita/create')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-plus fa-sm text-white-50"></i> Add</a>
    </div>

    <!-- Content Row -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Semua Berita</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered tableUserAwal" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal Berita</th>
                            <th>Judul Berita</th>
                            <th>Gambar</th>
                            <th>Pembuat Berita</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Tanggal Berita</th>
                            <th>Judul Berita</th>
                            <th>Gambar</th>
                            <th>Pembuat Berita</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($berita as $key => $b)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$b->tanggal_berita}}</td>
                            <td>{{$b->judul_berita}}</td>
                            @if (file_exists(public_path('/file_berita/'.$b->gambar_berita)))
                                <td><a href="{{ url('/file_berita/'.$b->gambar_berita) }}"><img style="height: 200px;width: 200px" src="{{ url('/file_berita/'.$b->gambar_berita) }}" alt="..." class="d-block img-fluid"></a></td>
                            @else
                                <td><img src="https://cdn.bodybigsize.com/wp-content/uploads/2020/03/noimage-15.png" alt="..." class="d-block img-fluid" height="400" width="400"></td>
                            @endif
                            <td>{{$dinas[$key][0]->name}}</td>
                            <td>
                            <button onclick="show('{{$b->id}}','{{$dinas[$key][0]->name}}')" class="btn btn-secondary btn-circle">
                                <i class="fas fa-eye"></i>
                            </button>
                            <a href='{{url("/admin_pu/berita/edit/".$b->id)}}' class="btn btn-primary btn-circle">
                                <i class="fas fa-edit"></i>
                            </a> <button onclick="destroy('{{$b->id}}','{{$dinas[$key][0]->name}}')" class="btn btn-danger btn-circle">
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

<!-- Show User Modal-->
<div id="show_modal" class="modal animated  fadeInUp" data-backdrop="static" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Berita detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <div class="modal-body">
                <p class="modal-text">
                        <div class="form-group">
                            <label>Tanggal berita :</label>
                            <input type="text" id="tanggal_berita" class="form-control" disabled>
                        </div>
                        <div class="form-group">
                            <label>Tanggal muat:</label>
                            <input type="text" id="tanggal_muat" class="form-control" disabled>
                        </div>
                        <div class="form-group">
                            <label>Judul berita:</label>
                            <input type="text" id="judul_berita" class="form-control" disabled>
                        </div>
                        <div class="form-group">
                            <label>Isi berita:</label>
                            <p id="isi_berita"></p>
                        </div>
                        <div class="form-group">
                            <label>Pembuat berita:</label>
                            <input type="text" id="pembuat_berita" class="form-control" placeholder="Last name" readonly>
                        </div>
                </p>
            </div>

        </div>
    </div>
</div>


<!-- Delete User Modal-->
<div id="delete_modal" class="modal animated  fadeInUp" data-backdrop="static" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Berita</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <div class="modal-body">
                <p class="modal-text">
                    <p>Are you sure want to delete this?</p>
                    <form id="form_data">
                        <div class="form-group">
                            <label>Id :</label>
                            <input type="text" name="id" id="id_delete" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label>Judul berita:</label>
                            <input type="text" name="judul_berita" id="judul_berita_delete" class="form-control" placeholder="First name" readonly>
                        </div>
                        <div class="form-group">
                            <label>Pembuat berita:</label>
                            <input type="text" name="pembuat_berita" id="pembuat_berita_delete" class="form-control" readonly>
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


    function show(id,nama_pembuat){
        toShow();
        console.log(id);
        console.log(nama_pembuat);
        $.ajax({
            url: '{{ url("/admin_pu/berita/show") }}',
            type: 'POST',
            dataType: 'JSON',
            data: {
                id: id
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {

                $('#tanggal_berita').val(response.tanggal_berita);
                $('#tanggal_muat').val(response.tanggal_muat);
                $('#judul_berita').val(response.judul_berita);
                $('#isi_berita').html(response.isi_berita);
                $('#pembuat_berita').val(nama_pembuat);
            },
            error: function() {

            }
        });
    }

    function destroy(id,nama_pembuat) {
        toDelete();
        $.ajax({
            url: '{{ url("/admin_pu/berita/destroy") }}',
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
                $('#judul_berita_delete').val(response.judul_berita);
                $('#pembuat_berita_delete').val(nama_pembuat);
                $('#btn_softdelete').attr('onclick', 'softdelete(' + id + ')');
                $('#btn_delete').attr('onclick', 'harddelete(' + id + ')');
            },
            error: function() {

            }
        });
    }
    function softdelete(id) {
        $.ajax({
            url: '{{ url("/admin_pu/berita/softdelete") }}',
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
            url: '{{ url("/admin_pu/berita/harddelete") }}',
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
