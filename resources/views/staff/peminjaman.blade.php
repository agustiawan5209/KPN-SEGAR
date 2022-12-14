@extends('layouts.master')
@section('content')

@section('title', 'riwayatPinjam')
@section('riwayatPinjam', 'active')
@section('transaksi-nav', 'show')

<main id="main" class="main">

    <div class="pagetitle">
        {{-- <h1>Data Jenis Aset</h1> --}}
        {{-- <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Tables</li>
          <li class="breadcrumb-item active">Data</li>
        </ol>
      </nav> --}}
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row align-items-top">
            <div class="col-lg-14">


                <div class="card">
                    <div class="card-body">

                        <center>
                            <h5 style="align-content: center" class="card-title">Riwayat Pembelian
                                {{ auth()->user()->name }}
                            </h5>
                            <center>


                                <!-- Table with stripped rows -->
                                <table class="table datatable">
                                    <thead>
                                        <tr>
                                            <x-th scope="col sm">No</x-th>
                                            <x-th scope="col">Kode </x-th>
                                            <x-th scope="col">Nama </x-th>
                                            <x-th scope="col">Tgl Peminjaman</x-th>
                                            <x-th scope="col">Tgl Pengembalian</x-th>
                                            <x-th scope="col">barang pinjam</x-th>
                                            <x-th scope="col">jumlah pinjam </x-th>
                                            <x-th scope="col">Detail</x-th>
                                            <x-th scope="col">status</x-th>



                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $nomor = 1;
                                        ?>
                                        @foreach ($pinjam as $data)
                                        <tr role="row">
                                            <x-td>{{ $nomor++ }}</x-td>
                                            <x-td> {{ $data->kode_peminjaman }}</x-td>
                                            <x-td> {{ $data->anggota->detail_anggota->nama_lengkap }}</x-td>
                                            <x-td> <?php echo date('d F Y', strtotime($data->tgl_pengajuan)); ?> </x-td>
                                            <x-td> <?php echo date('d F Y', strtotime($data->tgl_kembali)); ?></x-td>
                                            <x-td>{{ $data->barangs->nama_barang }}</x-td>
                                            <x-td>{{ $data->jumlah_pinjam }}</x-td>
                                            <x-td>
                                                <a href="{{ route('detail_pinjam' ,['id'=> $data->id]) }}" class="btn btn-info">
                                                    <i class="bi bi-eye-fill"></i>
                                                </a>
                                            </x-td>
                                            <x-td>
                                             @include('status')

                                            </x-td>

                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                    </div>
                </div>
            </div>
        </div> <!-- End Table with stripped rows -->

        </div>
        </div>

    @endsection
