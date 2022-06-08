<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

      <h1 class="logo me-auto"><a href="{{ url('/') }}"><span>Dinas Pekerjaan Umum Sumber Daya Air</span><br> Kabupaten Sumenep</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo me-auto me-lg-0"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a href="{{ url('/') }}" >Home</a></li>

          <li class="dropdown"><a href="#"><span>Tentang Kami</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="{{ url('/about') }}">Profil</a></li>
              <li><a href="{{ url('/strukturorganisasi') }}">Struktur Organisasi</a></li>
              <li><a href="{{ url('/visimisi') }}">Visi Misi</a></li>
              <li><a href="{{ url('/tugaspokok') }}">Tugas Pokok</a></li>
              <li><a href="{{ url('/fungsi') }}">Fungsi</a></li>
            </ul>
          </li>

          <li><a href="{{ url('/berita') }}">Berita</a></li>
          <li><a href="{{ url('/pengaduan') }}" class="active">Pegaduan</a></li>
          <li><a href="{{ url('/petawilayah') }}">Peta Wilayah</a></li>
          <li><a href="{{ url('/agenda') }}">Agenda</a></li>
          <li><a href="{{ url('/gallery/rakyat') }}">Gallery</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

      <div class="header-social-links d-flex">
        <a href="#" class="twitter"><i class="bu bi-twitter"></i></a>
        <a href="#" class="facebook"><i class="bu bi-facebook"></i></a>
        <a href="#" class="instagram"><i class="bu bi-instagram"></i></a>
        <a href="#" class="linkedin"><i class="bu bi-linkedin"></i></i></a>
      </div>

    </div>
  </header><!-- End Header -->

  <br>
  <section id="breadcrumbs" class="breadcrumbs">
    <div class="container">
      <div class="d-flex justify-content-between align-items-center">
        <h2>Add Pengaduan</h2>
        <ol>
            <li><a class="btn btn-primary" href="{{route('logout')}}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                {{ __('Logout') }}>Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form></li>
        </ol>

      </div>

    </div>
  </section><!-- End Breadcrumbs -->

  <section id="contact" class="contact">

      <div id="logo">
        {{-- <img src="{{asset('assets/img/blog/blog-1.jpg')}}" class="img-fluid" alt=""> --}}
        <img src="https://upload.wikimedia.org/wikipedia/commons/b/b9/Lambang_Kabupaten_Sumenep.png" class="img-fluid" alt="">

      </div>
    <div class="container">
      <div class="row mt-5 justify-content-center" data-aos="fade-up">
        <div class="col-lg-10">
            <div class="card">

                <h5 class="card-header text-center">Sampaikan laporan anda</h5>
                <div class="card-body text-center">

                    <form action="{{ url('/create_pengaduan/store') }}" method="post" enctype="multipart/form-data">

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

                        {{ csrf_field() }}
                        <label class="form-check-label" for="pengaduan">Choose one <span style="color: red">*</span></label>
                        <br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jenis_pengaduan" id="pengaduan" value="pengaduan">
                            <label class="form-check-label" for="pengaduan">Pengaduan</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jenis_pengaduan" id="aspirasi" value="aspirasi">
                            <label class="form-check-label" for="aspirasi">Aspirasi</label>
                        </div>
                        <br>
                        @if ($errors->has('jenis_pengaduan'))
                            <span class="text-danger">{{ $errors->first('jenis_pengaduan') }}</span>
                        @endif
                        <br>
                        <div class="form-group">
                            <label for="judulPengaduan">Judul Pengaduan <span style="color: red">*</span></label>
                            <input type="text" class="form-control" id="judulPengaduan" name="judul_pengaduan" placeholder="Masukkan judul pengaduan">
                            @if ($errors->has('judul_pengaduan'))
                                    <span class="text-danger">{{ $errors->first('judul_pengaduan') }}</span>
                                @endif
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="idipengaduan">Isi Pengaduan <span style="color: red">*</span></label>
                            <textarea class="form-control" id="isipengaduan" name="isi_pengaduan" rows="5"></textarea>
                            @if ($errors->has('isi_pengaduan'))
                                    <span class="text-danger">{{ $errors->first('isi_pengaduan') }}</span>
                                @endif
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="tanggalkejadian">Tanggal Kejadian <span style="color: red">*</span></label>
                            <input type="date" class="form-control" id="tanggalkejadian" name="tanggal_kejadian" aria-describedby="tanggalkejadians">
                            <small id="tanggalkejadians" class="form-text text-muted">Bila tidak tahu maka bisa diisi tanggal sekarang.</small>
                            <br>
                            @if ($errors->has('tanggal_kejadian'))
                                    <span class="text-danger">{{ $errors->first('tanggal_kejadian') }}</span>
                                @endif
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="lokasipengaduan">Lokasi <span style="color: red">*</span></label>
                            <input type="text" class="form-control" id="lokasipengaduan" name="lokasi_pengaduan" placeholder="Masukkan lokasi ">
                            @if ($errors->has('lokasi_pengaduan'))
                                    <span class="text-danger">{{ $errors->first('lokasi_pengaduan') }}</span>
                                @endif
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="katpengaduan">Kategori Pengaduan <span style="color: red">*</span></label>
                            <select class="form-control" id="katpengaduan" name="katpengaduan">
                                <option value="">--Pilih--</option>
                                @foreach($katpengaduan as $kp)
                                    <option value="{{ $kp->id }}">{{ $kp->nama }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('katpengaduan'))
                                    <span class="text-danger">{{ $errors->first('katpengaduan') }}</span>
                                @endif
                        </div>
                        <br>
                        <div class="form-group">
                            <label>Tambah Gambar <span style="color: red">*</span></label>
                            <input type="file" name="gambar" id="gambar">
                            <br>
                            @if ($errors->has('gambar'))
                                    <span class="text-danger">{{ $errors->first('gambar') }}</span>
                                @endif
                        </div>
                        <br>
                        <div class="form-group">
                            <label>Tambah Doc</label>
                            <input type="file" name="file" id="file">
                            <br>
                            @if ($errors->has('file'))
                                <span class="text-danger">{{ $errors->first('file') }}</span>
                            @endif
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
              </div>
            </div>
        </div>

      </div>

    </div>
  </section><!-- End Contact Section -->
