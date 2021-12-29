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
                        <h3 class="text-white">Tambah Surat Perintah</h3>
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

                        <form method="POST" action="{{ url('/admin_pu/surat_perintah/store') }}" enctype="multipart/form-data">

                            {{ csrf_field() }}

                            <div class="form-group">
                                <strong>No Surat Perintah:</strong>
                                <input type="text" name="no_surat_perintah" class="form-control" placeholder="no_surat_perintah">
                                @if ($errors->has('no_surat_perintah'))
                                    <span class="text-danger">{{ $errors->first('no_surat_perintah') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <strong>Tanggal Surat Perintah:</strong>
                                <input type="date" name="tanggal_surat_perintah" class="form-control" >

                            </div>

                            <div class="form-group">
                                <strong>Pesan:</strong>
                                <textarea name="pesan" id="pesan" class="form-control" rows="3" placeholder="Pesan"></textarea>

                            </div>

                            <div class="form-group">
                                <label>Lokasi:</label>
                                <input type="text" name="lokasi" class="form-control" placeholder="Lokasi">

                            </div>

                            <div class="form-group">
                                <strong>Laporan:</strong>
                                <input type="text" name="laporan" class="form-control" placeholder="Laporan">
                            </div>

                            <div class="form-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="file_doc" id="file_doc">
                                    <label class="custom-file-label" for="file_doc">Pilih file doc</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="gambar" id="gambar">
                                    <label class="custom-file-label" for="gambar">Pilih Gambar</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="dinas_tujuan">Pegawai Dinas Tujuan</label>
                                <select class="form-control" id="dinas_tujuan" name="dinas_tujuan">
                                    <option value="">--Pilih--</option>
                                    @foreach($dinas as $d)
                                        <option value="{{ $d->id }}">{{ $d->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="pengaduan_assign">Pengaduan</label>
                                <select class="form-control" id="pengaduan_assign" name="pengaduan_assign">
                                    <option value="">--Pilih--</option>
                                    @foreach($pengaduan as $p)
                                        <option value="{{ $p->id }}">{{ $p->judul_pengaduan }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <strong>Status:</strong>
                                <Select class="form-control" name="status_laporan">
                                    <option value="0">Pending</option>
                                    <option value="1">Done</option>
                                    <option value="2">Cancel</option>
                                </Select>
                            </div>

                            <div class="form-group text-center">
                                <button class="btn btn-success btn-submit">Save</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
