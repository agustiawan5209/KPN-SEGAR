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
                            <h5 style="align-content: center" class="card-title">Data Peminjaman
                                {{ $data->kode_peminjaman }}
                            </h5>
                        </center>
                        <!-- Table with stripped rows -->
                        <table class="table " id="peminjaman">
                            <thead>
                                <tr>
                                    <th scope="col sm">No</th>
                                    <th scope="col">Kode </th>
                                    <th scope="col">Nama </th>
                                    <th scope="col">kode Anggota </th>
                                    <th scope="col">Tgl Pengembalian</th>
                                    <th scope="col">jumlah pinjam </th>
                                    <th scope="col">Bunga </th>
                                    <th scope="col">Status</th>
                                    {{-- <th scope="col">Aksi</th> --}}

                                </tr>
                            </thead>

                            <tbody>
                                <td>1</td>
                                <td> {{ $data->kode_peminjaman }}</td>
                                <td> {{ $data->nama_peminjam }}</td>
                                <td>{{ $data->kode_anggota }}</td>

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
                                <td>Rp. {{ number_format($data->jumlah_pinjam, 0, 2) }}</td>
                                <td>Rp. {{ number_format($data->bunga, 0, 2) }}</td>
                                <td>
                                    @include('status')
                                </td>

                                </tr>
                            </tbody>
                        </table>

                        <br>
                        <center>
                            <h5 style="align-content: center" class="card-title">Data Peminjaman
                                {{ $data->kode_peminjaman }}
                            </h5>
                        </center>
                        <!-- Table with stripped rows -->
                        <table class="table " id="peminjaman">
                            <thead>
                                <tr>
                                    <th scope="col sm">No</th>
                                    <th scope="col">Kode </th>
                                    <th scope="col">Tanggal Angsuran </th>
                                    <th scope="col">Jumlah Bayar </th>
                                    <th scope="col">Sisa Bayar</th>
                                    <th scope="col">Status Angsuran </th>
                                    <th scope="col">denda </th>
                                    <th scope="col">Jumlah Denda</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($angsuran as $item)
                                    <tr>
                                        <td style="font-size: 13px;">{{ $loop->iteration }}</td>
                                        <td style="font-size: 13px;">{{ $item->kode_angsuran }}</td>
                                        <td style="font-size: 13px;">{{ $item->tgl_angsuran }}</td>
                                        <td style="font-size: 13px;">Rp. {{ number_format($item->jumlah_bayar) }}</td>
                                        <td style="font-size: 13px;">Rp. {{ number_format($item->sisa_bayar ,0,2)}}</td>
                                        <td style="font-size: 13px;">
                                            <?php
                                            $d = Carbon\Carbon::parse($item->tgl_angsuran);
                                            $e = Carbon\Carbon::parse(now());
                                            if ($d >= $e) {
                                                $waktu = $d->diffInDays($e) + 1;
                                            } else {
                                                $waktu = -$d->diffInDays($e);
                                            } ?>

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
                                        <td style="font-size: 13px;">{{ $item->denda }}</td>
                                        <td style="font-size: 13px;">{{ $item->jumlah_denda }}</td>
                                        <td style="font-size: 13px;">
                                            <!--EDIT DATA JENIS ASET-->
                                            <a href="{{route('pinjamUang.editAngsuran', ['id'=> $item->id])}}" type="button" class="btn btn"
                                                style="background-color: #05b3c3; color:#FFFFFF"><i
                                                    class="bi bi-pencil"></i></a>
                                            <a href="{{route('pinjamUang.destroyAngsuran', ['id'=> $item->id, 'pinjam_id'=> $data->id])}}"
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
