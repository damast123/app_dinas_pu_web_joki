<!DOCTYPE html>
<html lang="en">

@include('admin.layout.head')

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
            @include('admin.layout.sidebar')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                @include('admin.layout.header')
                <!-- Begin Page Content -->
                @include($data['content'],$data)
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
            @include('admin.layout.footer')
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    @include('admin.layout.modal')
</body>
    @include('admin.layout.js')
</html>
