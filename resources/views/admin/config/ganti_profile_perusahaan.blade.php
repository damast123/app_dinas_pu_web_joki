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
                        <h3 class="text-white">Ganti Profil Perusahaan</h3>
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

                        <form method="POST" action="{{ url('/admin_pu/ganti_profile_perusahaan/change') }}" enctype="multipart/form-data">

                            {{ csrf_field() }}

                            <div class="form-group">
                                <label class="font-weight-bold">Informasi PU</label>
                                <textarea class="form-control" name="informasipu" rows="5" placeholder="Masukkan Informasi PU">{{ $profile['informasi_pu'] }}</textarea>
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Visi</label>
                                <textarea class="form-control" name="visi" rows="5" placeholder="Masukkan Visi">{{ $profile['visi'] }}</textarea>
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Misi</label>
                                <textarea class="form-control" name="misi" rows="5" placeholder="Masukkan Misi">{{ $profile['misi'] }}</textarea>
                            </div>

                            @if ($profile['struktur_organisasi']==null)
                                <img width="250px" height="250px" src="https://bitsofco.de/content/images/2018/12/broken-1.png">
                            @else
                                <a href="{{ url('/profile/'.$profile['struktur_organisasi']) }}"><img width="250px" height="250px" src="{{ url('/profile/'.$profile['struktur_organisasi']) }}"></a>
                            @endif
                            <div class="form-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="gambar" id="gambar" value="{{$profile->struktur_organisasi}}">
                                    <label class="custom-file-label" for="gambar">Pilih gambar</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Fungsi</label>
                                <textarea class="form-control" name="fungsi" rows="5" placeholder="Masukkan Konten Fungsi">{{ $profile['fungsi'] }}</textarea>

                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Tugas Pokok</label>
                                <textarea class="form-control" name="tugas" rows="5" placeholder="Masukkan Konten Tugas Pokok">{{ $profile['tugas_pokok'] }}</textarea>

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
        CKEDITOR.replace( 'informasipu' );
        CKEDITOR.replace( 'visi' );
        CKEDITOR.replace( 'misi' );
        CKEDITOR.replace( 'fungsi' );
        CKEDITOR.replace( 'tugas' );
    </script>
</body>
</html>
