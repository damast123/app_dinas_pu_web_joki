<!DOCTYPE html>
<html>
<head>

    <!-- References: https://github.com/fancyapps/fancyBox -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>


    <style type="text/css">
    .gallery
    {
        display: inline-block;
        margin-top: 20px;
    }
    .close-icon{
    	border-radius: 50%;
        position: absolute;
        right: 5px;
        top: -10px;
        padding: 5px 8px;
    }
    .form-image-upload{
        background: #e8e8e8 none repeat scroll 0 0;
        padding: 15px;
    }
    </style>
</head>
<body>


<div class="container">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Gallery : {{$count}}</h1>
        <button onclick="addgal()" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-plus fa-sm text-white-50"></i> Add</button>
    </div>


        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Gallery</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered tableUserAwal" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th style="width: 15%">Title</th>
                                <th style="width: 30%">Keterangan</th>
                                <th>File</th>
                                <th>Uploader</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th style="width: 15%">Tittle</th>
                                <th style="width: 30%">Keterangan</th>
                                <th>File</th>
                                <th>Uploader</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($gallery as $key => $image)
                                <tr>
                                    <td>{{ $image->title }}</td>
                                    <td>{{ $image->keterangan }}</td>
                                    @if (strpos($image->file,'.jpg') !== false || strpos($image->file,'.png') !== false || strpos($image->file,'.jpeg') !== false || strpos($image->file,'.gif') !== false || strpos($image->file,'.svg') !== false)
                                        @if (file_exists(public_path('/file_gallery/'.$image->gambar)))
                                            <td><a href="{{ url('/file_gallery/'.$image->file) }}"><img style="height: 200px;width: 200px" src="{{ url('/file_gallery/'.$image->file) }}" alt="..." class="d-block img-fluid"></a></td>
                                        @else
                                            <td><img src="https://cdn.bodybigsize.com/wp-content/uploads/2020/03/noimage-15.png" alt="..." class="d-block img-fluid" height="400" width="400"></td>
                                        @endif

                                    @else
                                        @if (file_exists(public_path('/file_gallery/'.$image->gambar)))
                                            <td><video width="200" height="200" controls class="thumb" data-full="{{ url('/file_gallery/'.$image->file) }}">
                                                <source src="{{ url('/file_gallery/'.$image->file) }}"></video>
                                            </td>
                                        @else
                                            <td><img src="https://static.thenounproject.com/png/3255198-200.png" alt="..." class="d-block img-fluid" height="400" width="400"></td>
                                        @endif
                                    @endif
                                    <td>{{ $dinas[$key][0]->name }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

</div> <!-- container / end -->

<div id="add_gallery" class="modal" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah gallery</h5>
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
                    <form id="form_data" enctype="multipart/form-data" method="POST">

                        <div class="form-group">
                            <label>Title :</label>
                            <input type="text" name="title" id="title" class="form-control" placeholder="Title">
                            @if ($errors->has('title'))
                                <span class="text-danger">{{ $errors->first('title') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Keterangan:</label>
                            <Textarea name="keterangan" id="keterangan" class="form-control" placeholder="Keterangan"></Textarea>
                        </div>
                        <div class="form-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="gambar" id="gambar">
                                <label class="custom-file-label" for="gambar">Pilih gambar</label>
                            </div>
                            <br>
                            @if ($errors->has('gambar'))
                                <span class="text-danger">{{ $errors->first('gambar') }}</span>
                            @endif
                        </div>

                    </form>
                </p>
            </div>
            <div class="modal-footer md-button">
                <button type="button" class="btn btn-warning" id="save" onclick="create()" style="display:none;">Save</button>
                <button type="button" class="btn btn-danger" id="cancel" onclick="cancel()" style="display:none;">Cancel</button>
            </div>
        </div>
    </div>
</div>

<div id="loading" class="modal animated  fadeInUp" data-backdrop="static" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Load</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <div class="modal-body">
                <img src='https://media.giphy.com/media/3oEjI6SIIHBdRxXI40/giphy.gif'/>
            </div>
        </div>
    </div>
</div>


</body>


<script type="text/javascript">
    $(document).ready(function(){
        $(".fancybox").fancybox({
            openEffect: "none",
            closeEffect: "none"
        });
    });
    function toAdd() {
        $('#add_gallery').modal('show');
        $('#save').show();
        $('#cancel').show();
        reset();
    }
    function reset() {
        $('#form_data').trigger('reset');
        $('#validation_alert').hide();
        $('#validation_content').html('');
    }
    function cancel() {
        reset();
        $('#form_modal').modal('hide');
    }
    function addgal() {
        toAdd();
    }
    function success() {
        reset();
        $('#loading').modal('hide');
        $('#add_gallery').modal('hide');
        location.reload();
    }
    function create() {
        var postData = new FormData($("#form_data")[0]);
        console.log(postData);
        $.ajax({
            url: '{{ url("/admin_pu/gallery/store") }}',
            type: 'POST',
            dataType: 'JSON',
            data: postData,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function() {
                $('#loading').modal('show');
                $('#add_gallery').modal('hide');
            },
            success: function(response) {
                console.log(response.status);
                console.log(response);
                if(response.status == 200) {
                    success();
                } else if(response.status == 422) {
                    $('#loading').modal('hide');
                    $('#add_gallery').modal('show');
                    $('#validation_alert').show();
                    $('.modal-body').scrollTop(0);

                    $.each(response.error, function(i, val) {
                        $('#validation_content').append(`
                            <li>` + val + `</li>
                        `);
                    })
                } else {
                    alert(response.message);
                    $('#loading').modal('hide');
                    $('#add_gallery').modal('show');

                }
            },
            error: function() {
                $('.modal-body').scrollTop(0);
                alert("error");
                $('#loading').modal('hide');
                $('#add_gallery').modal('show');
            }
        });
    }
</script>
</html>
