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
            {{-- @php
        foreach ($data as $d) {
        foreach (App\Models\Barang::where('id', $d->barangs_id)->get() as $barang) {
        echo $barang->kode . '</br>' . $d->jumlah . '</br>';
        }
        }
        @endphp --}}

            <div class="row">
                <div class="col-lg">
                    <div class="row">
                        <div class="col-xxl-3 col-md-3">
                            <div class="card info-card sales-chart">
                                <div class="card-body">
                                    <h5 class="card-title">Aset Bergerak</h5>
                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"
                                            style="background-color: rgba(246, 246, 254, 0.795); ">
                                            <i class="bi bi-briefcase"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ $asetbergerak }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-3">
                            <div class="card info-card sales-chart">
                                <div class="card-body">
                                    <h5 class="card-title">Aset Tidak Bergerak</h5>
                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"
                                            style="background-color: rgba(246, 246, 254, 0.795); ">
                                            <i class="bi bi-briefcase"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ $asettidakbergerak }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-3">
                            <div class="card info-card sales-chart">
                                <div class="card-body">
                                    <h5 class="card-title">Aset Peralatan</h5>
                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"
                                            style="background-color: rgba(246, 246, 254, 0.795); ">
                                            <i class="bi bi-briefcase"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ $asetperalatan }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-3">
                            <div class="card info-card sales-chart">
                                <div class="card-body">
                                    <h5 class="card-title">Aset Perlengkapan</h5>
                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"
                                            style="background-color: rgba(246, 246, 254, 0.795); ">
                                            <i class="bi bi-briefcase"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ $asetperlengkapan }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row d-flex justify-content-start ">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Peminjaman Terbaru</h5>
                            <div class="accordion" id="accordionExample">
                                @foreach ($pinjam_barang as $pinjam_barang)
                                    @foreach ($pinjam_barang->unreadNotifications as $item)
                                        @if ($item != null)
                                            <div class="accordion-item">
                                                <h2 class="accordion-header d-flex justify-content-between" id="headingOne{{$pinjam_barang->id}}">

                                                     <button
                                                        class="accordion-button" type="button" data-bs-toggle="collapse"
                                                        data-bs-target="#collapseOne{{$pinjam_barang->id}}" aria-expanded="true"
                                                        aria-controls="collapseOne{{$pinjam_barang->id}}">
                                                        {{$item->data['nama']}}
                                                    </button>
                                                    <a href="{{route('delete-notif', ['id'=> $pinjam_barang->id])}}" class=" d-flex p-3 text-danger pointer-event">X</a>
                                                </h2>
                                                <div id="collapseOne{{$pinjam_barang->id}}" class="accordion-collapse collapse"
                                                    aria-labelledby="headingOne{{$pinjam_barang->id}}" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                         <strong>Nama</strong> : {{$item->data['nama']}} <br>
                                                         <strong>Barang</strong> : {{$item->data['barang']}} <br>
                                                         <strong>Jumlah</strong> : {{$item->data['jumlah']}} <br>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    @endsection
