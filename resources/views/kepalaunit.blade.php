@extends('layouts.master')
@section('content')
{{-- @section('title', 'pengajuan')
@section('pengajuan', 'active')
@section('iconss-nav', 'show') --}}

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
                                <h5 class="card-title text-center pb-0 fs-4">Selamat Datang Kepala Unit
                                    {{ auth()->user()->name }}
                                </h5>
                                <h5 class="card-title">Sistem Aset KPN “SEGAR” POLITEKNIK PELAYARAN BAROMBONG</h5>

                    </div>

                </div><!-- End Card with an image on bottom -->

            </div>
        </div>

        {{-- @php
        foreach ($data as $d) {
        foreach (App\Models\Barang::where('id', $d->barangs_id)->get() as $barang) {
        echo $barang->kode . '</br>' . $d->jumlah . '</br>';
        }
        }
        @endphp --}}
        {{-- <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Doughnut Chart</h5>

                    <!-- Doughnut Chart -->
                    <canvas id="doughnutChart" style="max-height: 400px;"></canvas>
                    <script>
                        const Data = {!! json_encode($datap) !!}
                            const LABEL = []
                            const JUMLAH = []
                            Data.map(item => {
                                LABEL.push(item.kode + ' - ' + item.spesifikasi + '-' + item.spesifikasi)
                                JUMLAH.push(item.jumlah)
                            })
                            document.addEventListener("DOMContentLoaded", () => {
                                new Chart(document.querySelector('#doughnutChart'), {
                                    type: 'doughnut',
                                    data: {
                                        labels: LABEL,
                                        datasets: [{
                                            label: 'My First Dataset',
                                            data: JUMLAH,
                                            backgroundColor: [
                                                'rgb(255, 99, 132)',
                                                'rgb(54, 162, 235)',
                                                'rgb(255, 205, 86)'
                                            ],
                                            hoverOffset: 4
                                        }]
                                    }
                                });
                            });
                    </script>
                    <!-- End Doughnut CHart -->

                </div>
            </div>
        </div> --}}
        <div class="row">
            <div class="col-lg">
                <div class="row">
                    <div class="col-xxl-3 col-md-6">
                        <div class="card info-card sales-chart">
                            <div class="card-body text-center d-flex">
                                <h5 class="card-title" style="font-size: 2rem !important;">Jumlah Aset</h5>
                                <div class="d-flex align-items-center">
                                    <div style="font-size: 2rem !important;" class="card-icon rounded-circle d-flex align-items-center justify-content-center" style="background-color: rgba(246, 246, 254, 0.795); ">
                                      :
                                    </div>
                                    <div class="ps-3" style="font-size: 2rem !important;">
                                        <h1>{{$jumlah}}</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-md-6">
                        <div class="card info-card sales-chart">
                            <div class="card-body text-center d-flex">
                                <h5 class="card-title" style="font-size: 2rem !important;">Jumlah Pinjaman</h5>
                                <div class="d-flex align-items-center">
                                    <div style="font-size: 2rem !important;" class="card-icon rounded-circle d-flex align-items-center justify-content-center" style="background-color: rgba(246, 246, 254, 0.795); ">
                                      :
                                    </div>
                                    <div class="ps-3" style="font-size: 2rem !important;">
                                        <h1>{{$pinjam}}</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
    </section>
    @endsection
