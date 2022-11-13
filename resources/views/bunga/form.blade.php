<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Tambah Akun staff- Sistem Inventaris dan Peminjaman Barang KPN “SEGAR” POLITEKNIK PELAYARAN BAROMBONG</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('logo/favicon.png') }}" rel="icon">
    <link href="{{ asset('logo/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('admin/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('admin/assets/css/style.css') }}" rel="stylesheet">

    <!-- =======================================================
  * Template Name: NiceAdmin - v2.2.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <main>
        <div class="container">

            <section
                class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                            <div class="d-flex justify-content-center py-4">
                                <a href="index.html" class="logo d-flex align-items-center w-auto">
                                    <img src="{{ asset('logo/logo.jpg') }}" alt="">
                                    <span class="d-none d-lg-block">Sistem Inventaris</span>
                                </a>
                            </div><!-- End Logo -->

                            <div class="card mb-3">

                                <div class="card-body">

                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Tambah Jenis Bunga</h5>
                                    </div>

                                    <form class="row g-3 needs-validation" novalidate method="POST"
                                        action="{{ isset($edit) ?  route('JenisBunga.update', ['JenisBunga'=> $jenisBunga->id]) :route('JenisBunga.store') }}">
                                        @csrf
                                        @if (isset($edit))
                                            @method("PUT")
                                        @else
                                            @method("POST")
                                        @endif
                                        <div class="col-12">
                                            <label for="yourName" class="form-label">kode</label>
                                            <input id="kode" type="text"
                                                class="form-control @error('kode') is-invalid @enderror" name="kode"
                                                value="{{ isset($edit) ? $jenisBunga->kode : old('kode') }}" required autocomplete="kode" autofocus>
                                            @error('kode')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                            <div class="invalid-feedback">Please, enter your name!</div>
                                        </div>

                                        <div class="col-12">
                                            <label for="yourusername" class="form-label"> Jumlah Bulan</label>
                                            <input id="jumlah_bulan" type="number"
                                                class="form-control @error('jumlah_bulan') is-invalid @enderror" name="jumlah_bulan"
                                                value="{{ isset($edit) ? $jenisBunga->jumlah_bulan : old('jumlah_bulan') }}" required autocomplete="jumlah_bulan">
                                            @error('jumlah_bulan')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="invalid-feedback">Please enter a valid username adddress!</div>
                                        </div>

                                        <div class="col-12">
                                            <label for="yourusername" class="form-label"> Jumlah Bunga</label>
                                            <input id="jumlah_bunga" type="number"
                                                class="form-control @error('jumlah_bunga') is-invalid @enderror" name="jumlah_bunga"
                                                value="{{ isset($edit) ? $jenisBunga->jumlah_bunga : old('jumlah_bunga') }}" required autocomplete="jumlah_bunga">
                                            @error('jumlah_bunga')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="invalid-feedback">Please enter a valid username adddress!</div>
                                        </div>


                                        <div class="col-12">
                                            <button class="btn btn w-100"
                                                style="background-color: #494cf6; color:#FFFFFF" type="submit">submit</button>
                                        </div>
                                    </form>

                                </div>
                            </div>



                        </div>
                    </div>
                </div>

            </section>

        </div>
    </main><!-- End #main -->

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
    <script src="{{ asset('admin/assets/vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('admin/assets/js/main.js') }}"></script>

</body>

</html>
