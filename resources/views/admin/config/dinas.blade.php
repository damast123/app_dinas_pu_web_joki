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
                                    <button onclick="show({{$d->id}})" class="btn btn-secondary btn-circle">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    </button>
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

<script>

    function toShow() {
        $('#show_modal').modal('show');
        $('#validation_alert').hide();
        $('#validation_content').html('');
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
                console.log(response);
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

</script>
