@extends('layouts.master')
@section('content')

@section('title', 'mutasi')
@section('mutasi', 'active')
@section('charts-nav', 'show')

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
        <div class="row">
            <div class="col-lg-12">


                <div class="card">
                    <div class="card-body  overflow-scroll">
                        <h5 class="card-title">
                            Data Mutasi &nbsp;&nbsp;&nbsp;
                        </h5>

                        <form action="{{ route('mutasi-filter') }}">
                            <select name="filter" id="filter">
                                <option value="{{ $filter }}">Semua</option>
                                @foreach ($jenis as $item)
                                    @if ($item->id != 2)
                                        <option value="{{ $item->id }}">{{ $item->nama_jenisaset }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-sm"
                                style="background-color:  #012970; color:#FFFFFF">Filter</button>
                        </form>

                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>

                                    <th scope="col">Kode/Spesifikasi</th>
                                    <th scope="col">Jenis Aset</th>
                                    <th scope="col">Jumlah Satuan</th>
                                    <th scope="col">Lokasi</th>
                                    {{-- <th scope="col">Ket</th> --}}
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                {{-- <form action="#" id="form"> --}}
                                @foreach ($barang as $item)
                                    <tr>
                                        <td>
                                            {{ $loop->iteration }}
                                            {{-- <input type="checkbox" checked name="check" id="check">
                                                <input type="text" name="id" id="d{{ $item->id }}"
                                                    value="{{ $item->id }}"> --}}
                                        </td>

                                        <td>{{ $item->kode }}/{{ $item->spesifikasi }}</td>
                                        <td>{{ $item->jenis_asets->nama_jenisaset }}</td>
                                        <td>{{ $item->jumlah }}</td>
                                        @if ($item->lokasi_aset == null)
                                            <td>{{ $item->lokasipenempatan->lantai }}/{{ $item->lokasipenempatan->ruangan }}
                                            </td>
                                        @else
                                            <td>{{ $item->lokasi_aset }}</td>
                                        @endif
                                        {{-- <td>{{ $item->ket }}</td> --}}
                                        <td><button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#mutasi{{ $item->id }}">
                                                Mutasi
                                            </button>

                                            <div class="modal fade" id="mutasi{{ $item->id }}" tabindex="-1">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">

                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('mutasi-create') }}" method="POST"
                                                                enctype="multipart/form-data" class="px-4 ">
                                                                @csrf
                                                                <input type="hidden" name="id"
                                                                    value={{ $item->id }}>
                                                                <input type="hidden" name="users_id"
                                                                    value={{ Auth::user()->id }}>
                                                                <div class="row align-items-center">
                                                                    {{--  --}}
                                                                        <h5 style="" class="card-title col-sm-2">Tgl Mutasi</h5>
                                                                        <div class="col-sm-10">
                                                                            <input type="date"
                                                                                id="validationTooltip1"
                                                                                name="tgl_mutasi" class="form-control"
                                                                                required
                                                                                placeholder="Isikan keterangan">
                                                                            <div class="invalid-feedback">
                                                                                Harus di isi
                                                                            </div>
                                                                        </div>
                                                                    {{-- </center> --}}
                                                                </div>
                                                                <div class="row row align-items-center">
                                                                        <h5 style="" class="card-title col-sm-2"> Lokasi Awal
                                                                        </h5>
                                                                        <div class="col-sm-10">
                                                                            @if ($item->lokasi_aset ==null)
                                                                                <input type="text"
                                                                                    id="validationTooltip02" name="dari"
                                                                                    class="form-control" required
                                                                                    placeholder="Isikan keterangan"
                                                                                    value="Lantai {{ $item->lokasipenempatan->lantai }} / Ruangan {{ $item->lokasipenempatan->ruangan }}">
                                                                            @else
                                                                            <input type="text"
                                                                                    id="validationTooltip02" name="dari"
                                                                                    class="form-control" readonly required
                                                                                    placeholder="Isikan keterangan"
                                                                                    value="{{$item->lokasi_aset}}">
                                                                            @endif
                                                                            <div class="invalid-feedback">
                                                                                Harus di isi
                                                                            </div>
                                                                        </div>
                                                                </div>
                                                                <div class="row align-items-center">
                                                                        <label for="validationTooltip06"
                                                                            class="card-title col-sm-2">lokasi</label>
                                                                        <div class="col-sm-10">
                                                                            <select class="form-select"
                                                                                id="validationTooltip06" name="ke"
                                                                                aria-label="Default select example">
                                                                                <option value=''>Isi Lokasi Mutasi
                                                                                </option>
                                                                                @foreach ($lokasi as $item)
                                                                                    <option
                                                                                        value="{{ $item->id }}">
                                                                                        Lantai {{ $item->lantai }} /
                                                                                        Ruangan {{ $item->ruangan }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                            @error('ke')
                                                                                <div class="text-danger">
                                                                                    Harus di isi
                                                                                </div>
                                                                            @enderror
                                                                        </div>
                                                                    <div class="row align-items-center">

                                                                            <h5 style="" class="card-title col-sm-3">
                                                                                Jumlah Mutasi
                                                                            </h5>
                                                                            <div class="col-sm-9">
                                                                                <input type="text" required
                                                                                    id="validationTooltip04"
                                                                                    name="jumlah_mutasi" class="form-control"
                                                                                    placeholder="Isikan Jumlah Mutasi">
                                                                                <div class="invalid-feedback">
                                                                                    Harus di isi
                                                                                </div>
                                                                            </div>
                                                                    </div>
                                                                    <div class="row align-items-center mb-3">

                                                                            <h5 style="" class="card-title col-sm-3">
                                                                                Keterangan
                                                                            </h5>
                                                                            <div class="col-sm-9">
                                                                                <input type="text" required
                                                                                    id="validationTooltip04"
                                                                                    name="ket" class="form-control"
                                                                                    placeholder="Isikan Keterangan">
                                                                                <div class="invalid-feedback">
                                                                                    Harus di isi
                                                                                </div>
                                                                            </div>
                                                                    </div>
                                                                    <br>
                                                                    <button type="submit" class="btn btn btn-sm"
                                                                        style=" float :right; background-color:   #012970; color:#FFFFFF">submit</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                {{-- </form> --}}
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>

            </div>
        </div>

        <script>
            var checkForm = document.querySelectorAll("#check");
            console.log(checkForm);
            checkForm.forEach(function() {
                this.addEventListener('click', function() {
                    // $(this).prop("checked", false);
                    console.log($(this).attr())
                    // if (this.checked == true) {
                    //     console.log('cek')
                    // } else {
                    //     console.log('no')
                    // }
                })
            })
        </script>
    </section>
@endsection
