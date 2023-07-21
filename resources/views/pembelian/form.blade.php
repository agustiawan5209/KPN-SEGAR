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
                            <h5 style="align-content: center" class="card-title">Data Pembelian

                            </h5>
                        </center>

                                <a href="{{ route('Pembelian.cekdata') }}" class="btn btn-primary"
                                    style="background-color: #163e85;">Beli Barang</a>

                                <!-- Table with stripped rows -->
                                <table class="table datatable" id="peminjaman">
                                    <thead>
                                        <tr>
                                            <th scope="col sm">No</th>
                                            <th scope="col">Kode </th>
                                            <th scope="col">Nama </th>
                                            <th scope="col">Tgl Pembelian</th>
                                            <th scope="col">Barang</th>
                                            <th scope="col">Total </th>
                                            <th scope="col">Detail</th>
                                            <th scope="col">Status</th>
                                            {{-- <th scope="col">Aksi</th> --}}

                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $nomor = 1;
                                        ?>
                                        @foreach ($pinjam as $data)
                                            <tr role="row">
                                                <td>{{ $nomor++ }}</td>
                                                <td> {{ $data->kode_peminjaman }}</td>
                                                <td> {{ $data->nama_peminjam }}</td>
                                                <td> <?php echo date('d F Y', strtotime($data->tgl_pengajuan)); ?> </td>

                                                <td>{{ $data->barangs->kode }}
                                                    {{ $data->barangs->jenis_barangs->jenis_barang }}
                                                    {{ $data->barangs->nama_barang }}
                                                </td>
                                                <td>Rp. {{ number_format($data->jumlah_pinjam,0,2) }} </td>
                                                <td>
                                                    @include('pembelian.modal-pembelian')
                                                </td>
                                                <td>
                                                    @include('status')
                                                </td>

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
