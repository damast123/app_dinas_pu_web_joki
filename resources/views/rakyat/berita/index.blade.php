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
<section id="breadcrumbs" class="breadcrumbs">
    <div class="container">

      <div class="d-flex justify-content-between align-items-center">
        <h2>Berita</h2>
        <ol>
          <li>Home</li>
          <li>Berita</li>
        </ol>
      </div>

    </div>
  </section><!-- End Breadcrumbs -->
<!-- ======= Blog Section ======= -->
<section id="blog" class="blog">
    <div class="container" data-aos="fade-up">

      <div class="row">
        @if ($berita->isEmpty())
            <div class="col-lg-8 entries">
                <article class="entry">
                        <h2 class="entry-title" style="text-align: center; padding-top: 5%; padding-bottom: 5%">
                            <p>No Data</p>
                        </h2>
                </article>

            </div><!-- End blog entries list -->

            <div class="col-lg-4">

            <div class="sidebar">
                <h3 class="sidebar-title" style="text-align: center; padding-top: 5%; padding-bottom: 5%">Berita Sebelumnya</h3>
            </div><!-- End sidebar -->

            </div><!-- End blog sidebar -->

        @else
            <div class="col-lg-8 entries">
                @foreach ($berita as $key => $b)
                    <article class="entry">
                        @if ($b->gambar_berita!=null)
                            <div class="entry-img">
                                <img src="{{url('/file_berita/'.$b->gambar_berita)}}" alt="" class="img-fluid">
                            </div>
                        @else
                            <div class="entry-img">
                                <img src="https://sharewell.eu/wp-content/themes/applounge/assets/images/no-image/No-Image-Found-400x264.png" alt="" class="img-fluid">
                            </div>
                        @endif

                        <h2 class="entry-title">
                            <a href="{{url('/berita/show').'/'.$b->id}}">{{$b->judul_berita}}</a>
                        </h2>

                        <div class="entry-meta">
                        <ul>
                            <li class="d-flex align-items-center"><i class="bi bi-person"></i>{{ $dinas[$key][0]->name }}</li>
                            <li class="d-flex align-items-center"><i class="bi bi-clock"></i>Tanggal Muat : {{$b->tanggal_muat}}</li>
                        </ul>
                        </div>

                        <div class="entry-content">
                            <div class="read-more">
                                <a href="{{url('/berita/show').'/'.$b->id}}">Read More</a>
                            </div>
                        </div>

                    </article>
                @endforeach

                <div class="blog-pagination">
                    {{ $berita->links() }}
                </div>

            </div><!-- End blog entries list -->

            <div class="col-lg-4">

            <div class="sidebar">

                <h3 class="sidebar-title">Berita Sebelumnya</h3>
                <div class="sidebar-item recent-posts">
                @foreach ($beritarecent as $brt)
                    <div class="post-item clearfix">
                        @if ($brt->gambar_berita!=null)
                        <div class="entry-img">
                            <img src="{{url('/file_berita/'.$brt->gambar_berita)}}" alt="" class="img-fluid">
                        </div>
                        @else
                            <div class="entry-img">
                                <img src="https://sharewell.eu/wp-content/themes/applounge/assets/images/no-image/No-Image-Found-400x264.png" alt="" class="img-fluid">
                            </div>
                        @endif
                    <h4><a href="{{url('/berita/show').'/'.$brt->id}}">{{$brt->judul_berita}}</a></h4>
                    <h4>{{$brt->tanggal_muat}}</h4>
                    </div>
                @endforeach
                </div><!-- End sidebar recent posts-->
            </div><!-- End sidebar -->

            </div><!-- End blog sidebar -->
        @endif
      </div>

    </div>
  </section><!-- End Blog Section -->
