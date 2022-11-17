@extends('layouts.master')
@section('content')

@section('title', 'pembelian')
@section('pembelian', 'active')
@section('iconss-nav', 'show')

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
            <div class="col-lg-15">


                <div class="card">
                    <div class="card-body p-0">

                        <center>
                            <h5 style="align-content: center" class="card-title">Data Pembelian

                            </h5>
                            <center>


                                <!-- Table with stripped rows -->
                                <table class="table datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col sm">No</th>
                                            <th scope="col">Kode </th>
                                            <th scope="col">Nama </th>
                                            <th scope="col">Tgl Pembelian</th>
                                            <th scope="col">barang</th>
                                            <th scope="col">Total </th>
                                            <th scope="col">Status</th>

                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $nomor = 1;
                                        ?>
                                        @foreach ($pinjam as $data)
                                            <tr role="row">
                                                <td class=" border">{{ $loop->iteration }}</td>
                                                <td class=" border"> {{ $data->kode_peminjaman }}</td>
                                                <td class=" border"> {{ $data->nama_peminjam }}</td>
                                                <td class=" border">
                                                    <?php echo date('d F Y', strtotime($data->tgl_pembelian)); ?>
                                                </td>
                                                <td class=" border">
                                                    {{$data->barangs->jenis_barangs->jenis_barang}}
                                                </td>
                                                <td class=" border">
                                                @if ($data->barangs_id == null)
                                                Rp {{ number_format($data->jumlah_pinjam) }}
                                                @else
                                                {{ $data->jumlah_pinjam }}
                                                @endif
                                                </td>
                                                @if ($data->jenis_peminjaman == 'Barang')
                                                    <td class=" border">
                                                        @include('modal')
                                                    </td>
                                                @endif


                                                <td class=" border">
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
