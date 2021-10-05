<!DOCTYPE html>
<html>
<head>
    <title>Surat Perintah</title>
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
                        <h3 class="text-white">Tambah Kategori Pengaduan</h3>
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

                        <form method="POST" action="{{ url('/admin_pu/kategori_pengaduan/store') }}">

                            {{ csrf_field() }}

                            <div class="form-group">
                                <strong>Nama Kategori:</strong>
                                <input type="text" name="nama_kategori" class="form-control" placeholder="masukkan nama kategori">
                                @if ($errors->has('nama_kategori'))
                                    <span class="text-danger">{{ $errors->first('nama_kategori') }}</span>
                                @endif
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
</body>
</html>
