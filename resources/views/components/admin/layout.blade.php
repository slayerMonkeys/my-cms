<x-app id="page-top">
    <x-slot name="styles">
        <link href="{{ asset("css/sb-admin-2.css") }}" rel="stylesheet">
        @isset($styles)
            {{ $styles }}
        @endisset
    </x-slot>

    <div id="wrapper">

        <!-- Sidebar -->
        <x-admin.sidebar />

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <x-admin.topbar />

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    {{ $slot }}
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2019</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>



    <x-slot name="scripts">
        <!-- Custom scripts for all pages-->
        <script src="{{ asset("js/sb-admin-2.min.js") }}"></script>

        @isset($scripts)
            {{ $scripts }}
        @endisset
    </x-slot>
</x-app>
