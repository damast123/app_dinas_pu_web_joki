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
        <br>
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
        @if ($agenda->isEmpty())
            <div class="col-lg-8 entries">
                <article class="entry">
                        <h2 class="entry-title" style="text-align: center; padding-top: 5%; padding-bottom: 5%">
                            <p>No Data</p>
                        </h2>
                </article>

            </div><!-- End blog entries list -->

            <div class="col-lg-4">

            <div class="sidebar">
                <h3 class="sidebar-title" style="text-align: center; padding-top: 5%; padding-bottom: 5%">Agenda besok</h3>
            </div><!-- End sidebar -->

            </div><!-- End blog sidebar -->

        @else
            <div class="col-lg-8 entries">
                @foreach ($agenda as $key => $a)
                <article class="entry">

                    <h2 class="entry-title">
                    <p>{{$a->nama_event}}</p>
                    </h2>

                    <div class="entry-meta">
                    <ul>
                        <li class="d-flex align-items-center"><i class="bi bi-person"></i> {{$dinas[$key][0]->name}}</li>
                        <li class="d-flex align-items-center"><i class="bi bi-calendar"></i> {{$a->tanggal_mulai}} - {{$a->tanggal_akhir}}</li>
                        <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <time>{{$a->jam}}</time></li>
                        <li class="d-flex align-items-center"><i class="bi bi-pin-map"></i> {!!$a->tempat_event!!}</li>
                    </ul>
                    </div>

                    <div class="entry-content">
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
                <h3 class="sidebar-title">Agenda sebelumnya</h3>

                    @foreach ($agenda_sebelum as $as)
                    <h4>{{$as->nama_event}}</h4>
                    <p>{!!$as->tempat_event!!}</p>
                    <button onclick="show('{{$as->id}}')" class="btn btn-secondary btn-circle">
                        show</button>
                    <br>
                    <br>
                    @endforeach

            </div><!-- End sidebar -->
            </div><!-- End blog sidebar -->
        @endif
      </div>
    </div>

    <div id="show_modal" class="modal animated  fadeInUp" data-backdrop="static" role="dialog">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Agenda Detail</h5>

                </div>
                <div class="modal-body">
                    <p class="modal-text">
                            <label>Nama event :</label>
                            <span id="name_show"></span>
                            <p></p>
                            <label>Tanggal :</label>
                            <span id="tanggal_show"></span>
                            <p></p>
                            <label>Jam:</label>
                            <time id="jam_show"></time>
                            <p></p>
                            <label>Deskripsi:</label>
                            <p id="deskripsi_show"></p>
                            <label>Tempat event:</label>
                            <span id="tempat_show"></span>
                    </p>
                </div>
            </div>
        </div>
    </div>
  </section><!-- End Blog Section -->

<script>

    function toShow() {
        $('#show_modal').modal('show');
        $('#validation_alert').hide();
        $('#validation_content').html('');
    }

    function toClose() {
        $('#show_modal').hide();
        $('#validation_alert').hide();
        $('#validation_content').html('');
    }

    function show(id){
        toShow();
        $.ajax({
            url: '{{ url("/agenda/show") }}',
            type: 'POST',
            dataType: 'JSON',
            data: {
                id: id
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                console.log(response);
                $('#name_show').html(response.nama_event);
                $('#tanggal_show').html(response.tanggal_mulai+' - '+response.tanggal_akhir);
                $('#jam_show').html(response.jam);
                $('#deskripsi_show').html(response.isi_event);
                $('#tempat_show').html(response.tempat_event);
            },
            error: function() {

            }
        });
    }

</script>
