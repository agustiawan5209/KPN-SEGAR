<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title> KPN “SEGAR” POLITEKNIK PELAYARAN BAROMBONG</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('logo/favicon.png') }}" rel="icon">
    <link href="{{ asset('logo/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="{{ asset('https://fonts.gstatic.com') }}" rel="preconnect">
    <link
        href="{{ asset('https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i') }}"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('admin/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <!-- Template Main CSS File -->
    <link href="{{ asset('admin/assets/css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- =======================================================
  * Template Name: NiceAdmin - v2.2.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
    <!-- WRAPPER -->
    <div id="wrapper">
        <!-- NAVBAR -->
        @include('layouts.includes.navbar')
        <!-- END NAVBAR -->
        <!-- LEFT SIDEBAR -->
        @include('layouts.includes.sidebar')
        <!-- END LEFT SIDEBAR -->
        <!-- MAIN -->
        @yield('content')
        <!-- END MAIN -->
        @include('sweetalert::alert')
        <div class="clearfix"></div>

        <!-- ======= Footer ======= -->
        <footer id="footer" class="footer">
            <div class="copyright">
                &copy; Copyright <strong><span>KPN “SEGAR” POLITEKNIK PELAYARAN BAROMBONG</span></strong>. All Rights
                Reserved 2022
            </div>

        </footer><!-- End Footer -->

        <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
                class="bi bi-arrow-up-short"></i></a>

        <!-- Vendor JS Files -->
        <script src="{{ asset('admin/assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
        <script src="{{ asset('admin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('admin/assets/vendor/chart.js/chart.min.js') }}"></script>
        <script src="{{ asset('admin/assets/vendor/echarts/echarts.min.js') }}"></script>
        <script src="{{ asset('admin/assets/vendor/quill/quill.min.js') }}"></script>
        <script src="{{ asset('admin/assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
        <script src="{{ asset('admin/assets/vendor/tinymce/tinymce.min.js') }}"></script>

        <!-- Template Main JS File -->
        <script src="{{ asset('admin/assets/js/main.js') }}"></script>
        @yield('js')
        <script>
            $(document).ready(function() {
                $('#peminjaman').DataTable({
                    // paging: false,
                    ordering: false,
                    info: false,
                });
                const ctx = document.getElementById('myChart');

                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                        datasets: [{
                            label: '# of Votes',
                            data: [12, 19, 3, 5, 2, 3],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            });
        </script>

</body>

</html>
