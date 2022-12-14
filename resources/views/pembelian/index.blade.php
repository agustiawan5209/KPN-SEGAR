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
                                            <x-th scope="col sm">No</x-th>
                                            <x-th scope="col">Kode </x-th>
                                            <x-th scope="col">Nama </x-th>
                                            <x-th scope="col">Tgl Pembelian</x-th>
                                            <x-th scope="col">Total </x-th>
                                            <x-th scope="col">Detail</x-th>
                                            <x-th scope="col">Status</x-th>
                                            @can('Pengurus')
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
                                                <x-td class=" border">{{ $loop->iteration }}</x-td>
                                                <x-td class=" border"> {{ $data->kode }}</x-td>
                                                <x-td class=" border"> {{ $data->nama }}</x-td>
                                                <x-td class=" border">
                                                    {{ $data->tgl_transaksi }}
                                                </x-td>
                                                <x-td class=" border">
                                                    {{ Str::currency($data->sub_total) }}
                                                </x-td>
                                                <x-td class=" border">
                                                    <a href="{{ route('Pembelian.detail', ['id' => $data->id]) }}"
                                                        class="btn btn-info"><i class='bi bi-eye-fill'></i></a>
                                                </x-td>

                                                <x-td>
                                                    @if ($data->status == 0)
                                                        <span class=" badge bg-danger">Belum Di konfirmasi</span>
                                                    @elseif($data->status == 1)
                                                        <span class="badge bg-primary">Telah Dikonfirmasi</span>
                                                    @elseif($data->status == 2)
                                                        <span class="badge bg-warning">Telah Di Tolak</span>
                                                    @endif
                                                </x-td>

                                                @can('Pengurus')
                                                    <x-td>
                                                        <!--STATUS BARANG DIAMBIL-->
                                                        @php
                                                            $statuss = App\Models\StatusPembelian::where('pembelian_id', $data->id)
                                                                ->orderBy('id', 'desc') //status dimana id nya terakhir dnegan kdoe tersebut
                                                                ->first();
                                                        @endphp
                                                        @if ($data->status == 1 && Auth::user()->roles_id == 1)
                                                            <button type="button" class="btn btn-info btn-sm"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#statuspembelian{{ $data->id }}">
                                                                <i class="bi bi-person-check-fill"></i>
                                                            </button>

                                                            <div class="modal fade" id="statuspembelian{{ $data->id }}"
                                                                tabindex="-1">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">

                                                                            <button type="button" class="btn-close"
                                                                                data-bs-dismiss="modal"
                                                                                aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form
                                                                                action="{{ route('Pembelian.status', ['id' => $data->id]) }}}}"
                                                                                method="GET"
                                                                                enctype="multipart/form-data">
                                                                                @csrf
                                                                                <div class="row mb-3">
                                                                                    <center>
                                                                                        <h5 style="align-content: center"
                                                                                            class="card-title">Keterangan
                                                                                            Pengiriman
                                                                                        </h5>
                                                                                        <center>
                                                                                            <div class="col-sm-10">
                                                                                                <input type="text"
                                                                                                    id="validationTooltip03"
                                                                                                    name="status"
                                                                                                    class="form-control"
                                                                                                    placeholder="Isikan Status Pembelian">
                                                                                                <div
                                                                                                    class="invalid-feedback">
                                                                                                    Harus di isi
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-sm-10">
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
                                                                                                class="btn btn btn-sm"
                                                                                                style=" float :right; background-color:   #012970; color:#FFFFFF">submit</button>

                                                                                </div>

                                                                            </form>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div><!-- End Basic Modal-->
                                                        @endif
                                                        @if ($data->status == 0 && Auth::user()->roles_id == 1)
                                                            <button type="button" class="btn btn-success btn-sm"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#statuspengembalian{{ $data->id }}">
                                                                <i class="bi bi-check"></i>
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
                                                                                action="{{ route('Pembelian.Konfirmasi', ['id' => $data->id]) }}}}"
                                                                                method="GET"
                                                                                enctype="multipart/form-data">
                                                                                @csrf
                                                                                <div class="row mb-3">
                                                                                    <center>
                                                                                        <h5 style="align-content: center"
                                                                                            class="card-title">Keterangan
                                                                                            Konfirmasi Pembelian
                                                                                        </h5>
                                                                                        <center>
                                                                                            <div class="col-sm-10">
                                                                                                <input type="text"
                                                                                                    id="validationTooltip03"
                                                                                                    name="status"
                                                                                                    class="form-control"
                                                                                                    placeholder="Isikan Status Pembelian">
                                                                                                <div
                                                                                                    class="invalid-feedback">
                                                                                                    Harus di isi
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-sm-10">
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
                                                                                                class="btn btn btn-sm"
                                                                                                style=" float :right; background-color:   #012970; color:#FFFFFF">submit</button>

                                                                                </div>

                                                                            </form>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div><!-- End Basic Modal-->
                                                        @endif
                                                        @if ($data->status == 0 && Auth::user()->roles_id == 1)
                                                            <!-- Basic Modal -->
                                                            <button type="button" class="btn btn-danger btn-sm"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#statustolak{{ $data->kode_peminjaman }}">
                                                                <i class="bi bi-x"></i>
                                                            </button>

                                                            <div class="modal fade"
                                                                id="statustolak{{ $data->kode_peminjaman }}"
                                                                tabindex="-1">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">

                                                                            <button type="button" class="btn-close"
                                                                                data-bs-dismiss="modal"
                                                                                aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form
                                                                                action="{{ route('Pembelian.Tolak', ['id' => $data->id]) }}"
                                                                                method="POST"
                                                                                enctype="multipart/form-data">
                                                                                @csrf
                                                                                <input type="hidden" name="status"
                                                                                    value='Pembelian Di Tolak'>
                                                                                <input type="hidden" name="barang_id"
                                                                                    value="{{ $data->barangs_id }}">
                                                                                <div class="row mb-3">
                                                                                    <center>
                                                                                        <h5 style="align-content: center"
                                                                                            class="card-title">Keterangan
                                                                                            Penolakan

                                                                                        </h5>
                                                                                        <center>
                                                                                            <div class="col-sm-10">
                                                                                                <input type="text"
                                                                                                    id="validationTooltip03"
                                                                                                    name="ket"
                                                                                                    class="form-control"
                                                                                                    placeholder="Isikan keterangan">
                                                                                                <div
                                                                                                    class="invalid-feedback">
                                                                                                    Harus di isi
                                                                                                </div>
                                                                                            </div><br>


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
                                                                {{ $statuss->status }}</span>
                                                        @endif


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
