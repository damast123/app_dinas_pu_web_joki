<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha512-MoRNloxbStBcD8z3M/2BmnT+rg4IsMxPkXaGh2zD6LGNNFE80W3onsAhRcMAMrSoyWL9xD7Ert0men7vR8LUZg==" crossorigin="anonymous" />
</head>
<body>
    <div class="container">
        <div class="row mt-12">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-info">
                        <h3 class="text-white">Buat berita</h3>
                    </div>
                    <div class="card-body">

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

                        <form method="POST" action="{{ url('/admin_pu/berita/store') }}" enctype="multipart/form-data">

                            {{ csrf_field() }}

                            <div class="form-group">
                                <label class="font-weight-bold">Tanggal Berita</label>
                                <input type="date" class="form-control" name="tanggal_berita">
                                @if ($errors->has('tanggal_berita'))
                                    <span class="text-danger">{{ $errors->first('tanggal_berita') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Tanggal Muat</label>
                                <input type="date" class="form-control" name="tanggal_muat">
                                @if ($errors->has('tanggal_muat'))
                                    <span class="text-danger">{{ $errors->first('tanggal_muat') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Judul Berita</label>
                                <input type="text" class="form-control" name="judul_berita">
                                @if ($errors->has('judul_berita'))
                                    <span class="text-danger">{{ $errors->first('judul_berita') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Isi Berita</label>
                                <textarea class="form-control" name="isi_berita" rows="5" placeholder="Masukkan Isi Berita"></textarea>
                                @if ($errors->has('isi_berita'))
                                    <span class="text-danger">{{ $errors->first('isi_berita') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="gambar" id="gambar">
                                    <label class="custom-file-label" for="gambar">Pilih gambar</label>
                                </div>
                            </div>

                            <div class="form-group text-center">
                                <button class="btn btn-success btn-submit">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'isi_berita' );
    </script>
</body>
</html>
