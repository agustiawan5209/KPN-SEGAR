@extends('layouts.master')
@section('content')
    {{-- @section('title', 'pengajuan')
@section('pengajuan', 'active')
@section('iconss-nav', 'show') --}}

    <main id="main" class="main">

        <section class="section dashboard">
            <div class="row align-items-top">
                <div class="col-lg-14">

                    <!-- Default Card -->
                    <div class="card">
                        <div class="card-body"><br>
                            <center> <img src="logo/logo.jpg" class="card-img-bottom" style="width: 90px;" alt="...">
                                <center>
                                    <h5 class="card-title text-center pb-0 fs-4">Selamat Datang Kepala
                                        {{ auth()->user()->name }}
                                    </h5>
                                    <h5 class="card-title">SISTEM INFORMASI KPN “SEGAR” POLITEKNIK PELAYARAN BAROMBONG</h5>

                        </div>

                    </div><!-- End Card with an image on bottom -->

                </div>
            </div>
        </section>
    @endsection
