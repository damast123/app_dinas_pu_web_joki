<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Profile Perusahaan</h1>
        <a href="{{url('/admin_pu/ganti_profile_perusahaan/edit')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-edit fa-sm text-white-50"></i> Change</a>
    </div>

    <!-- Content Row -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Semua perubahan di profile perusahaan</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered tableUserAwal" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal perubahan</th>
                            <th>Editor</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Tanggal perubahan</th>
                            <th>Editor</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        foreach ($profile as $key => $p) {
                            $id = $p['id'];
                            $no = $key+1;
                            echo "<tr>";
                            echo "<td>".$no."</td>";
                            echo "<td>".$p['created_at']."</td>";
                            echo "<td>".$dinas[$key][0]['name']."</td>";
                            echo '<td>

                                <button class="btn btn-info btn-circle" onclick="show('.$id.')">
                                    <i class="fas fa-eye"></i>
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

<div id="showProfile" class="modal animated  fadeInUp" data-backdrop="static" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Show detail</h5>
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
                            <label>About : </label>
                            <p id="about"></p>
                        </div>
                        <div class="form-group">
                            <label>Visi :</label>
                            <p id="visi"></p>
                        </div>
                        <div class="form-group">
                            <label>Misi : </label>
                            <p id="misi"></p>
                        </div>
                        <div class="form-group">
                            <p>Struktur organisasi :</p>
                            <img src="" id="preview_gambar" style="width: 100%;height: 100%">
                        </div>
                        <div class="form-group">
                            <label>Fungsi :</label>
                            <p id="fungsi"></p>
                        </div>
                        <div class="form-group">
                            <label>Tugas pokok :</label>
                            <p id="tugas_pokok"></p>
                        </div>
                    </form>
                </p>
            </div>
        </div>
    </div>
</div>

<script>

    function toShow() {
        $('#showProfile').modal('show');
    }

    function show(id) {
        toShow();
        $.ajax({
            url: '{{ url("/admin_pu/ganti_profile_perusahaan/show") }}',
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
                $('#about').html(response.informasi_pu);
                $('#visi').html(response.visi);
                $('#misi').html(response.misi);
                if(response.struktur_organisasi==''||response.struktur_organisasi==null)
                {
                    $('#preview_gambar').attr('src', "https://st3.depositphotos.com/23594922/31822/v/600/depositphotos_318221368-stock-illustration-missing-picture-page-for-website.jpg");
                }
                else
                {
                    console.log(response.struktur_organisasi);

                    $('#preview_gambar').attr('src', "{{ url('/profile') }}"+"/"+response.struktur_organisasi);
                }
                $('#fungsi').html(response.fungsi);
                $('#tugas_pokok').html(response.tugas_pokok);
            },
            error: function() {
            }
        });
    }
</script>
