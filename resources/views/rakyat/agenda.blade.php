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
          <li><a href="{{ url('/agenda') }}" class="active">Agenda</a></li>
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
        <h2>Agenda</h2>
        <ol>
          <li><p>Home</p></li>
          <li>Agenda</li>
        </ol>
      </div>

    </div>
  </section><!-- End Breadcrumbs -->
<!-- ======= Blog Section ======= -->
<section id="blog" class="blog">
    <div class="container" data-aos="fade-up">

      <div class="row">

        <div class="col-lg-8 entries">
            @foreach ($agenda as $key => $a)
            <article class="entry">

                <h2 class="entry-title">
                  <p>{{$a->nama_event}}</p>
                </h2>

                <div class="entry-meta">
                  <ul>
                    <li class="d-flex align-items-center"><i class="bi bi-person"></i> <p>{{$dinas[$key]->name}}</p></li>
                    <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <p>Tanggal : {{$a->tanggal_mulai}} - {{$a->tanggal_akhir}}</p></li>
                    <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <p><time>Jam : {{$a->jam}}</time></p></li>
                  </ul>
                </div>

                <div class="entry-content">
                    <i class="bi bi-pin-map"></i><p>
                        Tempat : {!!$a->tempat_event!!}
                    </p>
                    <p>
                        {!!$a->isi_event!!}
                    </p>
                </div>

              </article>
            @endforeach

            <div class="blog-pagination">
                {{$agenda->links()}}
            </div>
        </div><!-- End blog entries list -->

        <div class="col-lg-4">
          <div class="sidebar">
            <h3 class="sidebar-title">Agenda besok</h3>
            <div class="sidebar-item recent-posts">
                @foreach ($agenda_besok as $ab)
                    <div class="post-item clearfix">
                        <h4><a href="blog-single.html">Nihil blanditiis at in nihil autem</a></h4>
                        <time datetime="2020-01-01">Jan 1, 2020</time>
                    </div>
                @endforeach
            </div><!-- End sidebar recent posts-->
          </div><!-- End sidebar -->
        </div><!-- End blog sidebar -->
      </div>
    </div>
  </section><!-- End Blog Section -->
