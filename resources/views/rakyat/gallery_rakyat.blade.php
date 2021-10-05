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

          <li><a href="{{ url('/berita') }}">Berita</a></li>
          <li><a href="{{ url('/pengaduan') }}">Pegaduan</a></li>
          <li><a href="{{ url('/petawilayah') }}">Peta Wilayah</a></li>
          <li><a href="{{ url('/agenda') }}">Agenda</a></li>
          <li><a href="{{ url('/gallery/rakyat') }}" class="active">Gallery</a></li>
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
        <h2>Portfolio</h2>
        <ol>
          <li><a href="index.html">Home</a></li>
          <li>Portfolio</li>
        </ol>
      </div>

    </div>
  </section><!-- End Breadcrumbs -->

  <!-- ======= Portfolio Section ======= -->
  <section id="portfolio" class="portfolio">
    <div class="container">

      <div class="row" data-aos="fade-up">
        <div class="col-lg-12 d-flex justify-content-center">
          <ul id="portfolio-flters">
            <li data-filter="*" class="filter-active">All</li>
            <li data-filter=".filter-app">Photo</li>
            <li data-filter=".filter-card">Video</li>
          </ul>
        </div>
      </div>

      <div class="row portfolio-container" data-aos="fade-up">
          @foreach ($gallery as $g)
            @if (strpos($g->file,'.jpg') !== false || strpos($g->file,'.png') !== false || strpos($g->file,'.jpeg') !== false || strpos($g->file,'.gif') !== false || strpos($g->file,'.svg') !== false)
                <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                    <img src="{{ url('/gallery/'.$g->file) }}" class="img-fluid" alt="">
                    <div class="portfolio-info">
                        <h4>{{ $g->title }}</h4>
                        <p>{{ $g->keterangan }}</p>
                        <a href="{{ url('/gallery/'.$g->file) }}" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link"><i class="bx bx-plus"></i></a>
                    </div>
                </div>
            @else
                <div class="col-lg-4 col-md-6 portfolio-item filter-card">
                    <video width="300" height="300" controls class="thumb" data-full="{{ url('/gallery/'.$g->file) }}">
                        <source src="{{ url('/gallery/'.$g->file) }}">
                    </video>
                    <div class="portfolio-info">
                        <h4>{{ $g->title }}</h4>
                        <p>{{ $g->keterangan }}</p>
                    </div>
                </div>
            @endif
          @endforeach

      </div>

    </div>
  </section><!-- End Portfolio Section -->
