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
<!-- ======= Breadcrumbs ======= -->
<section id="breadcrumbs" class="breadcrumbs">
    <div class="container">

      <div class="d-flex justify-content-between align-items-center">
        <h2>Pengaduan</h2>
        <ol>
          <li><a href="{{url('/check_pengaduan')}}" class="btn btn-primary">Tambah Pengaduan</a></li>
        </ol>
      </div>

    </div>
  </section><!-- End Breadcrumbs -->
<!-- ======= Blog Section ======= -->
<section id="blog" class="blog">
    <div class="container" data-aos="fade-up">

      <div class="row">

        <div class="col-lg-12 entries">
            @if ($pengaduan->isEmpty())
            <article class="entry">

                <h2 class="entry-title" style="text-align: center; padding-top: 5%; padding-bottom: 5%">
                <p>No Data</p>
                </h2>

            </article>

            @else
                @foreach ($pengaduan as $key => $p)
                <article class="entry">

                    <div class="entry-img">
                    <img src="{{url('/gambarpengaduan/'.$p->file)}}" alt="" class="img-fluid">
                    </div>

                    <h2 class="entry-title">
                    <p>{{$p->judul_pengaduan}}</p>
                    </h2>

                    <div class="entry-meta">
                    <ul>
                        <li class="d-flex align-items-center"><i class="bi bi-person"></i> {{$rakyat[$key]->name}}</li>
                        <li class="d-flex align-items-center"><i class="bi bi-clock"></i>{{$p->tanggal_pengaduan}}</li>
                        <li class="d-flex align-items-center"><i class="bi bi-tag"></i>{{$p->jenis_pengaduan}}</li>
                    </ul>
                    </div>

                    <div class="entry-content">
                    <h4>
                        Tanggal kejadian : {{$p->tanggal_kejadian}}
                    </h4>
                    <p>
                        {{$p->isi_pengaduan}}
                    </p>
                    <div class="read-more">
                        @if ($p->status_pengaduan==0)
                            <h2>Status : Menunggu</h2>
                        @elseif ($p->status_pengaduan==1)
                            <h2>Status : Proses</h2>
                        @elseif ($p->status_pengaduan==2)
                            <h2>Status : Selesai</h2>
                        @else
                            <h2>Status : Tidak di acc</h2>
                        @endif
                    </div>
                    </div>

                </article>
                @endforeach
            @endif

            <div class="blog-pagination" style="text-align:center">
                {{ $pengaduan->links() }}
            </div>

        </div><!-- End blog entries list -->

      </div>

    </div>
  </section><!-- End Blog Section -->
