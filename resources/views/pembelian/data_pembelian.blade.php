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
                                            <th scope="col">Tujuan</th>
                                            <th scope="col">barang</th>
                                            <th scope="col">Total </th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Aksi</th>

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
                                                    <?php echo date('d F Y', strtotime($data->tgl_pinjam)); ?>
                                                </td>
                                                <td class=" border">

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
                                                        <p style="color:#cd0b30;" class="small fst-italic">
                                                            Sudah
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
                                                <td class=" border">{{ $data->tujuan }} </td>
                                                <td class=" border">
                                                @if ($data->barang_id == null)
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
                                                <td>
                                                    <!--STATUS BARANG DIAMBIL-->
                                                    @php
                                                        $statuss = App\Models\Trxstatus::where('kode_peminjaman', $data->kode_peminjaman)
                                                            ->orderBy('id', 'desc') //status dimana id nya terakhir dnegan kdoe tersebut
                                                            ->first();

                                                        $pinjam_status = App\Models\Pinjam::where('kode_peminjaman', '=', $statuss->kode_peminjaman)->first();

                                                    @endphp
                                                    @if ($statuss->status_id == 3  && Auth::user()->roles_id == 2)
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
                                                    @endif
                                                    @if ($statuss->status_id == 4 || $statuss->status_id == 6 && Auth::user()->roles_id == 2)
                                                        <span
                                                            class="badge border-dark border-1 text-dark small fst-italic"
                                                            style="color:#012970;">peminjaman
                                                            selesai</span>
                                                    @endif
                                                    {{-- @dd($data) --}}
                                                    @if ($statuss->status_id == 5 && Auth::user()->roles_id == 2)
                                                        <form action="/menyetujui/{{ $data->id }}" method="GET"
                                                            enctype="multipart/form-data">
                                                            @csrf
                                                            <input type="text" name="kode_peminjaman"
                                                                value={{ $data->kode_peminjaman }} hidden>
                                                            <input type="text" name="users_id"
                                                                value={{ Auth::user()->id }} hidden>

                                                            <button name="status_id" value="1"
                                                                class="btn btn-success btn-sm"> <i
                                                                    class="bi bi-check-lg"></i></button>
                                                        </form>
                                                        <!--STATUS DI TOLAK -->

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
                                                                        <form action="/insertstatus" method="POST"
                                                                            enctype="multipart/form-data">
                                                                            @csrf
                                                                            <input type="hidden"
                                                                                name="kode_peminjaman"
                                                                                value={{ $data->kode_peminjaman }}>
                                                                            <input type="hidden" name="users_id"
                                                                                value={{ Auth::user()->id }}>
                                                                            <input type="hidden" name="status_id"
                                                                                value="2">
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
                                                            sudah
                                                            diverifikasi</span>
                                                    @endif


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
