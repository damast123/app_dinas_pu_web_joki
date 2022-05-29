<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

      <h1 class="logo me-auto"><a href="{{ url('/') }}"><span>Dinas Pekerjaan Umum Sumber Daya Air</span><br> Kabupaten Sumenep</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo me-auto me-lg-0"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a href="{{ url('/') }}" class="active">Home</a></li>

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



  <main id="main">
<br>
    <!-- ======= About Us Section ======= -->
    <section id="about-us" class="about-us">
      <div class="container" data-aos="fade-up">
        <br>
        <br>
        <br>
        <div class="row content">
            <div class="col-lg-12" data-aos="fade-right">
                <h2>Profil Perusahaan</h2>
                {!! $data['informasi_pu']['informasi_pu'] !!}
            </div>
        </div>
        <br>
        <br><br>
        <h2>Gallery</h2>
      </div>
    </section><!-- End About Us Section -->

    <!-- ======= Hero Section ======= -->
    @if (count($gallery)>0)
        <section id="hero">

            <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">

            <div class="carousel-inner" role="listbox">


                @if (count($gallery)==1)
                <!-- Slide 1 -->
                <div class="carousel-item active" style="background-image: url('{{ url('/file_gallery/'.$gallery[0]->file) }}');">
                    <div class="carousel-container">
                        <div class="carousel-content animate__animated animate__fadeInUp">
                        <h2>{{$gallery[0]->title}}</h2>
                        <p>{{$gallery[0]->keterangan}}</p>
                        </div>
                </div>
                </div>

                @elseif (count($gallery)==2)
                <!-- Slide 1 -->
                <div class="carousel-item active" style="background-image: url('{{ url('/file_gallery/'.$gallery[0]->file) }}');">
                    <div class="carousel-container">
                        <div class="carousel-content animate__animated animate__fadeInUp">
                        <h2>{{$gallery[0]->title}}</h2>
                        <p>{{$gallery[0]->keterangan}}</p>
                        </div>
                </div>
                </div>

                <!-- Slide 2 -->
                <div class="carousel-item" style="background-image: url('{{ url('/file_gallery/'.$gallery[1]->file) }}');">
                    <div class="carousel-container">
                        <div class="carousel-content animate__animated animate__fadeInUp">
                            <h2>{{$gallery[1]->title}}</h2>
                            <p>{{$gallery[1]->keterangan}}</p>
                        </div>
                    </div>
                </div>

                @else
                <!-- Slide 1 -->
                <div class="carousel-item active" style="background-image: url('{{ url('/file_gallery/'.$gallery[0]->file) }}');">
                    <div class="carousel-container">
                        <div class="carousel-content animate__animated animate__fadeInUp">
                        <h2>{{$gallery[0]->title}}</h2>
                        <p>{{$gallery[0]->keterangan}}</p>
                        </div>
                </div>
                </div>

                <!-- Slide 2 -->
                <div class="carousel-item" style="background-image: url('{{ url('/file_gallery/'.$gallery[1]->file) }}');">
                    <div class="carousel-container">
                        <div class="carousel-content animate__animated animate__fadeInUp">
                            <h2>{{$gallery[1]->title}}</h2>
                            <p>{{$gallery[1]->keterangan}}</p>
                        </div>
                    </div>
                </div>

                <!-- Slide 3 -->
                <div class="carousel-item" style="background-image: url('{{ url('/file_gallery/'.$gallery[2]->file) }}');">
                    <div class="carousel-container">
                        <div class="carousel-content animate__animated animate__fadeInUp">
                            <h2>{{$gallery[2]->title}}</h2>
                            <p>{{$gallery[2]->keterangan}}</p>
                        </div>
                    </div>
                </div>

                @endif


            </div>

            <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
            </a>

            <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
            </a>

            <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

            </div>
        </section><!-- End Hero -->

    @else
        <div style="display:flex; justify-content:center;">
            <h1>No Image</h1>
        </div>
        <br>
        <br>
        <br>
    @endif
  </main><!-- End #main -->
