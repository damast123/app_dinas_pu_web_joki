<!DOCTYPE html>
<html>
<head>
    <title>Add Agenda</title>
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
                        <h3 class="text-white">Add Agenda</h3>
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

                        <form method="POST" action="{{ url('/admin_pu/agenda/store') }}">

                            {{ csrf_field() }}

                            <div class="form-group">
                                <label>Nama Event:</label>
                                <input type="text" name="nama_event" class="form-control">
                                @if ($errors->has('nama_event'))
                                    <span class="text-danger">{{ $errors->first('nama_event') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <strong>Tanggal Mulai:</strong>
                                <input type="date" name="tanggal_mulai" class="form-control">
                                @if ($errors->has('tanggal_mulai'))
                                    <span class="text-danger">{{ $errors->first('tanggal_mulai') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>Tanggal Akhir:</label>
                                <input type="date" name="tanggal_akhir" class="form-control">
                                @if ($errors->has('tanggal_akhir'))
                                    <span class="text-danger">{{ $errors->first('tanggal_akhir') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>Jam:</label>
                                <input type="time" name="jam" class="form-control">
                                @if ($errors->has('jam'))
                                    <span class="text-danger">{{ $errors->first('jam') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>Isi Event:</label>
                                <textarea name="isi_event" class="form-control" rows="3"></textarea>
                                @if ($errors->has('isi_event'))
                                    <span class="text-danger">{{ $errors->first('isi_event') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>Tempat Event:</label>
                                <input type="text" name="tempat_event" class="form-control">
                                @if ($errors->has('tempat_event'))
                                    <span class="text-danger">{{ $errors->first('tempat_event') }}</span>
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
