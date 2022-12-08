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
                            <h5 style="align-content: center" class="card-title">Data Peminjaman

                            </h5>
                        </center>

                                <a href="{{ route('pinjamUang.create') }}" class="btn btn-primary"
                                    style="background-color: #163e85;">Buat Pengajuan Baru</a>

                                <!-- Table with stripped rows -->
                                <table class="table datatable" id="peminjaman">
                                    <thead>
                                        <tr>
                                            <th scope="col sm">No</th>
                                            <th scope="col">Kode </th>
                                            <th scope="col">Nama </th>
                                            <th scope="col">kode Anggota </th>
                                            <th scope="col">Tgl Pengembalian</th>
                                            <th scope="col">jumlah pinjam </th>
                                            <th scope="col">Bunga </th>
                                            <th scope="col">Detail</th>
                                            <th scope="col">Aksi</th>

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
                                                <td>{{$data->kode_anggota}}</td>

                                                <td>

                                                    <?php
                                                    $d = Carbon\Carbon::parse($data->tgl_kembali);
                                                    $e = Carbon\Carbon::parse(now());
                                                    if ($d >= $e) {
                                                        $waktu = $d->diffInDays($e) + 1;
                                                    } else {
                                                        $waktu = -$d->diffInDays($e);
                                                    } ?>


                                                    {{ date('d F Y', strtotime($data->tgl_kembali)) }}


                                                    @if ($waktu < 0)
                                                        <p style="color:#cd0b30;" class="small fst-italic">Sudah
                                                            Terlewat {{ -$waktu }}
                                                            hari</p>
                                                    @elseif($waktu > 0)
                                                        <p style="color:#012970;" class="small fst-italic"><b>
                                                                {{ $waktu }} Hari Lagi </b>
                                                        </p>
                                                    @else
                                                        <p style="color:#012970;" class="small fst-italic"><b>Hari
                                                                Terakhir</b></p>
                                                    @endif


                                                </td>
                                                <td>Rp. {{number_format($data->jumlah_pinjam,0,2)}}</td>
                                                <td>Rp. {{number_format($data->bunga,0,2)}}</td>
                                                <td>
                                                    <a href="{{route('pinjamUang.show', ['id'=> $data->id])}}" type="button" class="btn btn"
                                                        style="background-color: #05b3c3; color:#FFFFFF"><i
                                                            class="bi bi-eye"></i></a>
                                                </td>
                                                <td>
                                                    <!--EDIT DATA JENIS ASET-->
                                                    <a href="{{route('pinjamUang.edit', ['id'=> $data->id])}}" type="button" class="btn btn"
                                                        style="background-color: #05b3c3; color:#FFFFFF"><i
                                                            class="bi bi-pencil"></i></a>
                                                    <a href="{{route('pinjamUang.destroy', ['id'=> $data->id])}}"
                                                        onclick="return confirm('Hapus Data?')" type="button"
                                                        class="btn btn-danger"><i class="bi bi-trash delete"></i></a>

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
