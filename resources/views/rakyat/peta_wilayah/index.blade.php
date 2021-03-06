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
          <li><a href="{{ url('/petawilayah') }}" class="active">Peta Wilayah</a></li>
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
        <h2>Peta Wilayah</h2>
        <ol>
          <li>Peta Wilayah</li>
        </ol>
      </div>

    </div>
  </section><!-- End Breadcrumbs -->
<!-- ======= Blog Section ======= -->
<section id="blog" class="blog">
    <div class="container" data-aos="fade-up">

      <div class="row">
        @if ($petawilayah->isEmpty())
            <article class="entry">
                    <h2 class="entry-title" style="text-align: center; padding-top: 5%; padding-bottom: 5%">
                        <p>No Data</p>
                    </h2>
            </article>
        @else
        <div class="col-lg-8 entries">
            @foreach ($petawilayah as $key => $pw)
            <article class="entry">
                @if ($pw->gambar)
                    <div class="entry-img">
                        <a href="{{ url('/petawilayahgambar/'.$pw->gambar) }}"><img src="{{ url('/petawilayahgambar/'.$pw->gambar) }}" alt="" class="img-fluid"></a>
                    </div>
                @endif

                <div class="entry-meta">
                  <ul>
                    <li class="d-flex align-items-center"><i class="bi bi-person"></i> {{$dinas[$key][0]->name}}</li>
                    <li class="d-flex align-items-center"><i class="bi bi-clock"></i>{{$pw->tanggal_dibuat}}</li>
                    <li class="d-flex align-items-center"><i class="bi bi-map"></i>{{$daerah[$key][0]->nama_daerah}}</li>
                  </ul>
                </div>

                    <div class="entry-content">
                        <div class="read-more">
                            <a href="{{ url('/petawilayah/show').'/'.$pw->id }}">View Detail</a>
                        </div>
                    </div>



              </article>
            @endforeach
            <div class="blog-pagination" style="text-align: center">
                {{ $petawilayah->links() }}
            </div>
        </div><!-- End blog entries list -->
        @endif

      </div>

    </div>
  </section><!-- End Blog Section -->
