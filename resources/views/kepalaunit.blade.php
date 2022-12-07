@extends('layouts.master')
@section('content')
    @section('title', 'dashboard')

    <main id="main" class="main">

        <div class="pagetitle">

        </div><!-- End Page Title -->

        <section class="section">
            <div class="row align-items-top">
                <div class="col-lg-14">

                    <!-- Default Card -->
                    <div class="card">
                        <div class="card-body"><br>
                            <center> <img src="logo/logo.jpg" class="card-img-bottom" style="width: 90px;" alt="...">
                                <center>
                                    <h5 class="card-title text-center pb-0 fs-4">Selamat Datang Anggota
                                        {{ auth()->user()->name }}
                                    </h5>
                                    <h5 class="card-title">Sistem Aset KPN “SEGAR” POLITEKNIK PELAYARAN BAROMBONG</h5>

                        </div>

                    </div><!-- End Card with an image on bottom -->

                </div>
            </div>
        </section>
    </main>
@endsection
