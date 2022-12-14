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
                        <div class="card-body">
                            <h5 class="card-title"> Detail Peminjaman Barang </h5>
                                <div class="row">
                                    <div class="col-lg-5 col-md-4 label "> 1. Kode Peminjaman</div>
                                    <div class="col-lg-7 col-md-8"> :{{ $pinjam->kode_peminjaman }} </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-5 col-md-4 label "> 2. Nama peminjam </div>
                                    <div class="col-lg-7 col-md-8"> :{{ $pinjam->anggota->detail_anggota->nama_lengkap }} </div>
                                </div>


                                <div class="row">
                                    <div class="col-lg-5 col-md-4 label "> 4. Tanggal pengajuan</div>
                                    <div class="col-lg-7 col-md-8">
                                        <td>: <?php echo date('d F Y', strtotime($pinjam->tgl_pengajuan)); ?> </td>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-5 col-md-4 label "> 6. Tanggal pengembalian</div>
                                    <div class="col-lg-7 col-md-8">
                                        <td> : <?php echo date('d F Y', strtotime($pinjam->tgl_kembali)); ?> </td>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-5 col-md-4 label "> 7. Surat Pengantar</div>
                                    <div class="col-lg-7 col-md-8">
                                        <img src="{{ asset('bukti_pinjam/'. $pinjam->bukti_pinjam) }}" />
                                    </div>
                                </div>

                            <h5 class="card-title"> Detail Barang </h5>
                                <div class="row">
                                    <div class="col-lg-5 col-md-4 label"> Barang  </div>

                                    <div class="col-lg-7 col-md-8"> : {{ $pinjam->barangs->kode }} -
                                        {{ $pinjam->barangs->jenis_barangs->jenis_barang }}
                                        {{ $pinjam->barangs->nama_barang }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-5 col-md-4 label "> Jumlah item </div>
                                    <div class="col-lg-7 col-md-8"> : {{ $pinjam->jumlah_pinjam }} </div>
                                </div>
                            <br>
                            <a href="/peminjaman/pengembalian "
                                style=" float :left; background-color:   #012970; color:#FFFFFF" button type="button"
                                class="btn btn-sm">Kembali</a>

                        </div>
                    </div><!-- End Default Card -->


                </div>
            </div>

            </div>
            </div>
        </section>
    @endsection
