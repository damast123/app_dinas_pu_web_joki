<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

      <h1 class="logo me-auto"><a href="{{ url('/') }}"><span>Dinas Pekerjaan Umum Sumber Daya Air</span><br> Kabupaten Sumenep</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo me-auto me-lg-0"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a href="{{ url('/') }}">Home</a></li>

          <li class="dropdown"><a href="#"><span>Tentang Kami</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="{{ url('/about') }}">Profil</a></li>
              <li><a href="{{ url('/strukturorganisasi') }}">Struktur Organisasi</a></li>
              <li><a href="{{ url('/visimisi') }}">Visi Misi</a></li>
              <li><a href="{{ url('/tugaspokok') }}">Tugas Pokok</a></li>
              <li><a href="{{ url('/fungsi') }}">Fungsi</a></li>
            </ul>
          </li>

          <li><a href="{{ url('/berita') }}" class="active">Berita</a></li>
          <li><a href="{{ url('/pengaduan') }}">Pegaduan</a></li>
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

<!-- ======= Breadcrumbs ======= -->
<br>
        <br>
<section id="breadcrumbs" class="breadcrumbs">
    <div class="container">

      <div class="d-flex justify-content-between align-items-center">
        <h2>Berita</h2>
        <ol>
          <li>Home</li>
          <li>Detail Berita</li>
        </ol>
      </div>

    </div>
  </section><!-- End Breadcrumbs -->
<!-- ======= Blog Section ======= -->
<section id="blog" class="blog">
    <div class="container" data-aos="fade-up">

      <div class="row">

        <div class="col-lg-12 entries">
                <article class="entry entry-single">
                    @if ($berita->gambar_berita!=null)
                        <div class="entry-img">
                            <img src="{{url('/file_berita/'.$berita->gambar_berita)}}" alt="" class="img-fluid">
                        </div>
                    @else
                        <div class="entry-img">
                            <img src="https://sharewell.eu/wp-content/themes/applounge/assets/images/no-image/No-Image-Found-400x264.png" alt="" class="img-fluid">
                        </div>
                    @endif

                    <h2 class="entry-title">
                        <a href="blog-single.html">{{$berita->judul_berita}}</a>
                    </h2>

                    <div class="entry-meta">
                    <ul>
                        <li class="d-flex align-items-center"><i class="bi bi-person"></i>{{ $dinas->name }}</li>
                        <li class="d-flex align-items-center"><i class="bi bi-clock"></i>Tanggal Muat : {{$berita->tanggal_muat}}</li>
                    </ul>
                    </div>

                    <div class="entry-content">
                        <p>
                            {!! $berita->isi_berita !!}
                        </p>
                    </div>

                </article>

        </div><!-- End blog entries list -->

      </div>

    </div>
  </section><!-- End Blog Section -->
