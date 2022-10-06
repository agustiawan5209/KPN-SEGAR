@extends('layouts.master')
@section('content')

<main class="main" id="main">
    <div class="container">
        <div class="row">
            <div class="col-md-full">
                <div class="card mb-3">

                    <div class="card-body">

                        <div class="pt-4 pb-2">
                            <h5 class="card-title text-center pb-0 fs-4">Edit Mutasi</h5>
                            {{-- <p class="text-center small">Isi data diri sesuai formulir dibawah ini</p> --}}
                        </div>

                        <form class="row g-3 needs-validation" novalidate action="{{route('mutasi-update', ['id'=> $mutasi->id])}}" method="POST"
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="col-12">
                                <label for="yourName" class="form-label">Barang</label>
                                <input id="barang_id" type="text" class="form-control @error('barang_id') is-invalid @enderror"
                                    name="barang_id" value="{{ $barang_id }}" required autocomplete="barang_id" readonly autofocus>
                                @error('barang_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="invalid-feedback">Please, enter your name!</div>
                            </div>

                            <div class="col-12">
                                <label for="yourEmail" class="form-label"> Tanggal Mutasi</label>
                                <input id="date" type="date" class="form-control @error('tgl_mutasi') is-invalid @enderror"
                                    name="tgl_mutasi" value="{{ $tgl_mutasi }}" required autocomplete="tgl_mutasi">
                                @error('tgl_mutasi')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="invalid-feedback">Please enter a valid Username adddress!</div>
                            </div>

                            <div class="col-12">
                                <label for="yourName" class="form-label">Lokasi</label>
                                <input id="dari" type="text" class="form-control @error('dari') is-invalid @enderror"
                                    name="dari" value="{{ $dari }}" readonly required autocomplete="dari" autofocus>
                                @error('dari')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <div class="invalid-feedback">Please, enter your name!</div>
                            </div>

                            <div class="col-12">
                                <label for="yourName" class="form-label">Lokasi Mutasi </label>
                                <select class="form-select"
                                    id="validationTooltip06" name="ke"
                                    aria-label="Default select example">
                                    <option value=''>{{$ke}}
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
                            <div class="col-12">
                                <label for="yourName" class="form-label">Jumlah Mutasi </label>
                                <input id="jumlah_mutasi" type="text" class="form-control @error('jumlah_mutasi') is-invalid @enderror"
                                    name="jumlah_mutasi" value="{{ $jumlah_mutasi }}" required autocomplete="name" autofocus>
                                @error('jumlah_mutasi')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <div class="invalid-feedback">Please, enter your name!</div>
                            </div>
                            <div class="col-12">
                                <label for="yourName" class="form-label">Keterangan </label>
                                <input id="ket" type="text" class="form-control @error('ket') is-invalid @enderror"
                                    name="ket" value="{{ $ket }}" required autocomplete="name" autofocus>
                                @error('ket')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <div class="invalid-feedback">Please, enter your name!</div>
                            </div>

                            <div class="col-12">
                                <button class="btn btn w-100" style="background-color: #494cf6; color:#FFFFFF" type="submit">
                                    submit</button>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
     </div>

</main>
@endsection
