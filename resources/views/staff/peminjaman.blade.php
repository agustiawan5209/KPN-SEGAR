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
                    <div class="card-body overflow-scroll">

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
                                            @can('Bendahara')
                                            <x-th scope="col">Aksi</x-th>
                                            @endcan
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
                                            @can('Bendahara')
                                            <td>
                                                <!--STATUS BARANG DIAMBIL-->
                                                @php
                                                    $statuss = App\Models\Trxstatus::where('kode_peminjaman', $data->kode_peminjaman)
                                                        ->orderBy('id', 'desc') //status dimana id nya terakhir dnegan kdoe tersebut
                                                        ->first();

                                                    $pinjam_status = App\Models\Pinjam::where('kode_peminjaman', '=', $statuss->kode_peminjaman)->first();

                                                @endphp
                                                @if ($statuss->status_id == 3 && Auth::user()->roles_id == 3)
                                                    <button type="button" class="btn btn-info btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#statuspengembalian{{ $data->id }}">
                                                        <i class="bi bi-person-check-fill"></i>
                                                    </button>

                                                    <div class="modal fade"
                                                        id="statuspengembalian{{ $data->id }}" tabindex="-1">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">

                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form
                                                                        action="/mengembalikan/{{ $data->id }}"
                                                                        method="GET"
                                                                        enctype="multipart/form-data">
                                                                        @csrf
                                                                        <input type="text" name="kode_peminjaman"
                                                                            value={{ $data->kode_peminjaman }}
                                                                            hidden>
                                                                        <input type="hidden" name="users_id"
                                                                            value={{ Auth::user()->id }}>
                                                                        <input type="hidden" name="status_id"
                                                                            value="4">
                                                                        <div class="row mb-3">
                                                                            <center>
                                                                                <h5 style="align-content: center"
                                                                                    class="card-title">Keterangan
                                                                                    Pengembalian
                                                                                </h5>
                                                                                <center>
                                                                                    <div class="col-sm-10">
                                                                                        <label for="">Tanggal Kembali</label>
                                                                                        <input type="date"
                                                                                            id="validationTooltip03"
                                                                                            name="tgl_kembali"
                                                                                            class="form-control"
                                                                                            placeholder="Isikan keterangan">
                                                                                        <div
                                                                                            class="invalid-feedback">
                                                                                            Harus di isi
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-sm-10">
                                                                                        <label for="">Keterangan</label>

                                                                                        <input type="text"
                                                                                            id="validationTooltip03"
                                                                                            name="ket"
                                                                                            class="form-control"
                                                                                            placeholder="Isikan keterangan">
                                                                                        <div
                                                                                            class="invalid-feedback">
                                                                                            Harus di isi
                                                                                        </div>
                                                                                    </div>
                                                                                    <br>
                                                                                    <button type="submit"
                                                                                        value=""
                                                                                        class="btn btn btn-sm"
                                                                                        style=" float :right; background-color:   #012970; color:#FFFFFF">submit</button>

                                                                        </div>

                                                                    </form>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div><!-- End Basic Modal-->
                                                @else
                                                    <span
                                                        class="badge border-dark border-1 text-dark small fst-italic text-wrap"
                                                        style="color:#012970;">
                                                       Telah DiKembalikan</span>
                                                @endif


                                            </td>
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
