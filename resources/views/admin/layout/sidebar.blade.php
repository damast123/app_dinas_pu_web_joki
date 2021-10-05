<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{url('/admin_pu')}}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{url('/admin_pu')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <li class="nav-item">
        <a class="nav-link" href="{{url('/admin_pu/surat_perintah')}}">
            <i class="fas fa-fw fa-envelope"></i>
            <span>Surat Perintah</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{url('/admin_pu/pengaduan')}}">
            <i class="fas fa-fw fa-exclamation"></i>
            <span>Pengaduan</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{url('/admin_pu/agenda')}}">
            <i class="fas fa-fw fa-calendar"></i>
            <span>Agenda</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{url('/admin_pu/peta_wilayah')}}">
            <i class="fas fa-fw fa-file"></i>
            <span>Peta Wilayah</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Setting
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
            aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-cog"></i>
            <span>Master Setting</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{url('/admin_pu/kategori_pengaduan')}}">Kategori Pengaduan</a>
                <a class="collapse-item" href="{{url('/admin_pu/gallery')}}">Gallery</a>
                <a class="collapse-item" href="{{url('/admin_pu/berita')}}">Berita</a>
                <a class="collapse-item" href="{{url('/admin_pu/ganti_profile_perusahaan')}}">Ganti Profil Perusahaan</a>
                <a class="collapse-item" href="{{url('/admin_pu/jabatan')}}">Jabatan</a>
                <a class="collapse-item" href="{{url('/admin_pu/role')}}">Role</a>
                <a class="collapse-item" href="{{url('/admin_pu/dinas')}}">Dinas</a>
            </div>
        </div>
    </li>



    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>


</ul>
