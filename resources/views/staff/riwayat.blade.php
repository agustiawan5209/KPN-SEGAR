@extends('layouts.master')
@section('content')

@section('title', 'pengajuan')
@section('pengajuan', 'active')
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
                                            <th scope="col sm">No</th>
                                            <th scope="col">Kode </th>
                                            <th scope="col">Nama </th>
                                            <th scope="col">Tgl Pengajuan</th>
                                            <th scope="col">Tgl Pengembalian</th>
                                            <th scope="col">Bunga </th>
                                            <th scope="col">Jumlah Pinjam </th>
                                            <th scope="col">Harga Barang </th>
                                            <th scope="col">Detail</th>
                                            {{-- <th scope="col">status</th> --}}



                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($pinjam as $data)
                                        @if ($data->status == 1)
                                            <tr role="row">
                                                <td>{{ $loop->iteration }}</td>
                                                <td> {{ $data->kode_peminjaman }}</td>
                                                <td> {{ $data->nama_peminjam }}</td>
                                                <td> <?php echo date('d F Y', strtotime($data->tgl_pengajuan)); ?> </td>
                                                <td> <?php echo date('d F Y', strtotime($data->tgl_kembali)); ?></td>
                                                <td>{{ $data->bunga }}</td>
                                                <td>{{ $data->jumlah_pinjam }}</td>
                                                <td>{{ $data->barangs->harga }}</td>
                                                <td>
                                                    <a href="{{ route('detail_pinjam', ['id'=> $data->id]) }}" class="btn btn-info text-white">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                </td>



                                            </tr>
                                        @endif
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
