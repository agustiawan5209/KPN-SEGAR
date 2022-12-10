@extends('layouts.master')
@section('content')

@section('title', 'pengajuan')
@section('pengajuan', 'active')
@section('iconss-nav', 'show')

<main id="main" class="main">

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
                                            <x-th scope="col">Tgl Pengajuan</x-th>
                                            <x-th scope="col">Tgl Pengembalian</x-th>
                                            <x-th scope="col">jumlah pinjam </x-th>
                                            <x-th scope="col">Detail</x-th>



                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($pinjam as $data)
                                            <tr role="row">
                                                <x-td>{{ $loop->iteration }}</x-td>
                                                <x-td> {{ $data->kode_peminjaman }}</x-td>
                                                <x-td> {{ $data->nama_peminjam }}</x-td>
                                                <x-td> <?php echo date('d F Y', strtotime($data->tgl_pengajuan)); ?> </x-td>
                                                <x-td> <?php echo date('d F Y', strtotime($data->tgl_kembali)); ?></x-td>
                                                <x-td>{{ Str::currency($data->jumlah_pinjam) }} </x-td>
                                                <x-td>
                                                    <a href="{{route('pinjamUang.show', ['id'=> $data->id])}}" type="button" class="btn btn"
                                                        style="background-color: #05b3c3; color:#FFFFFF"><i
                                                            class="bi bi-eye"></i></a>
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
