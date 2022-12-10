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
                            <h5 style="align-content: center" class="card-title">Data Pinjaman
                                {{ $data->kode_peminjaman }}
                            </h5>
                        </center>
                        <!-- Table with stripped rows -->
                        <table class="table " id="peminjaman">
                            <thead>
                                <tr>
                                    <x-th scope="col sm">No</x-th>
                                    <x-th scope="col">Kode </x-th>
                                    <x-th scope="col">Nama </x-th>
                                    <x-th scope="col">kode Anggota </x-th>
                                    <x-th scope="col">Tgl Pengembalian</x-th>
                                    <x-th scope="col">jumlah pinjam </x-th>
                                    <x-th scope="col">Bunga </x-th>
                                    <x-th scope="col">Status</x-th>
                                    {{-- <x-th scope="col">Aksi</x-th> --}}

                                </tr>
                            </thead>

                            <tbody>
                                <x-td>1</x-td>
                                <x-td> {{ $data->kode_peminjaman }}</x-td>
                                <x-td> {{ $data->nama_peminjam }}</x-td>
                                <x-td>{{ $data->kode_anggota }}</x-td>

                                <x-td>

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


                                </x-td>
                                <x-td>Rp. {{ number_format($data->jumlah_pinjam, 0, 2) }}</x-td>
                                <x-td>{{ number_format($data->bunga) }}%</x-td>
                                <x-td>
                                    @include('status')
                                </x-td>

                                </tr>
                            </tbody>
                        </table>

                        <br>
                        <center>
                            <h5 style="align-content: center" class="card-title">Data Angsuran Kode Pinjaman
                                {{ $data->kode_peminjaman }}
                            </h5>
                        </center>
                        <!-- Table with stripped rows -->
                        <table class="table " id="peminjaman">
                            <thead>
                                <tr>
                                    <x-th scope="col sm">No</x-th>
                                    <x-th scope="col">Kode </x-th>
                                    <x-th scope="col">Tanggal Angsuran </x-th>
                                    <x-th scope="col">Jumlah Bayar </x-th>
                                    <x-th scope="col">Sisa Bayar</x-th>
                                    <x-th scope="col">Status Angsuran </x-th>
                                    <x-th scope="col">denda </x-th>
                                    <x-th scope="col">Jumlah Denda</x-th>
                                    @can('Bendahara')
                                        <x-th scope="col">Aksi</x-th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($angsuran as $item)
                                    <tr>
                                        <x-td>{{ $loop->iteration }}</x-td>
                                        <x-td>{{ $item->kode_angsuran }}</x-td>
                                        <x-td>{{ $item->tgl_angsuran }}</x-td>
                                        <x-td>Rp. {{ number_format($item->jumlah_bayar) }}</x-td>
                                        <x-td>Rp. {{ number_format($item->sisa_bayar, 0, 2) }}</x-td>
                                        <x-td>
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

                                        </x-td>
                                        <x-td>
                                            {!! $item->textStatus($item->status) !!}
                                        </x-td>
                                        <x-td>{{ $item->jumlah_denda }}</x-td>
                                        @can('Bendahara')
                                            <x-td>
                                                <!--EDIT DATA JENIS ASET-->
                                                <a href="{{ route('pinjamUang.editAngsuran', ['id' => $item->id]) }}"
                                                    type="button" class="btn btn"
                                                    style="background-color: #05b3c3; color:#FFFFFF"><i
                                                        class="bi bi-pencil"></i></a>
                                                <a href="{{ route('pinjamUang.destroyAngsuran', ['id' => $item->id, 'pinjam_id' => $data->id]) }}"
                                                    onclick="return confirm('Hapus Data?')" type="button"
                                                    class="btn btn-danger"><i class="bi bi-trash delete"></i></a>
                                            </x-td>
                                        @endcan
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
