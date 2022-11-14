@extends('layouts.master')
@section('content')
    {{-- @section('title', 'pengajuan')
@section('pengajuan', 'active')
@section('iconss-nav', 'show') --}}

    <main id="main" class="main">
        <section class="section">
            <div class="row align-items-top">
                <div class="col-lg-full">
                    <!-- Default Card -->
                    <div class="card">
                        <div class="card-body"><br>
                            <center> <img src="logo/logo.jpg" class="card-img-bottom" style="width: 90px;" alt="..."><center>
                                    <h5 class="card-title">SISTEM INFORMASI KPN “SEGAR” POLITEKNIK PELAYARAN BAROMBONG</h5>
                        </div>

                    </div>
                </div>
            </div>
        </section>
        <div class="row">
            <div class="col-lg">
                <div class="row justify-content-center">
                    <div class="col">
                        <div class="card " style="background-color: #012970;">
                            <div class="card-body ">
                                <a href="{{ route('staff/pinjam') }}">
                                    <div class="card-title text-center">
                                        <span><i class="bi bi-file-earmark-break-fill text-danger"
                                                style="font-size: 50px"></i></span>
                                        <span class="text-light" style="font-size: 20px">Peminjaman</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card " style="background-color: #012970;">
                            <div class="card-body ">
                                <a href="{{ route('pinjamUang.index') }}">
                                    <div class="card-title text-center">
                                        <span><i class="bi bi-file-earmark-break-fill text-danger"
                                                style="font-size: 50px"></i></span>
                                        <span class="text-light" style="font-size: 20px">Pinjam Uang</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <div class="card-body" style="background-color: #012970;">
                                <a href="{{ route('staff/riwayat') }}">
                                    <div class="card-title text-center">
                                        <span class=""><i class="bi bi-receipt-cutoff text-warning"
                                                style="font-size: 50px"></i></span>
                                        <span class="text-light" style="font-size: 20px">Riwayat</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
