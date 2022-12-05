@extends('layouts.master')


@section('title', 'potongan-nav')
@section('diskonli', 'active')
@section('potongan-nav', 'show')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                <div class="d-flex justify-content-center py-4">
                    <a href="index.html" class="logo d-flex align-items-center w-auto">
                        <img src="{{ asset('logo/logo.jpg') }}" alt="">
                        <span class="d-none d-lg-block">Sistem Inventaris</span>
                    </a>
                </div><!-- End Logo -->

                <div class="card mb-3">

                    <div class="card-body">

                        <div class="pt-4 pb-2">
                            <h5 class="card-title text-center pb-0 fs-4">Tambah Diskon</h5>
                        </div>

                        <form class="row g-3 needs-validation" novalidate method="POST"
                            action="{{ route('Diskon.update', ['id'=> $diskon->id]) }}">
                            @csrf
                            @method('PUT')
                            <div class="col-12">
                                <label for="yourName" class="form-label">Barang</label>
                               <select name="barang_id" id="barang_id" class="form-select">
                                <option value="">--</option>
                                @foreach ($barang as $item)
                                    <option value="{{ $item->id }}" {{ $diskon->barang_id == $item->id ? 'selected' :''}}>- {{ $item->kode }} - {{ $item->spesifikasi }}</option>
                                @endforeach
                               </select>
                                <div class="invalid-feedback">Please, enter your name!</div>
                            </div>
                            <div class="col-12">
                                <label for="yourName" class="form-label">Diskon</label>
                                <input id="name" type="text"
                                    class="form-control @error('diskon') is-invalid @enderror" name="diskon"
                                    value="{{$diskon->diskon }}" required autocomplete="diskon" autofocus>
                                @error('diskon')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="invalid-feedback">Please, enter your name!</div>
                            </div>
                            <div class="col-12">
                                <label for="yourName" class="form-label">Tanggal Mulai</label>
                                <input id="name" type="date"
                                    class="form-control @error('tgl_mulai') is-invalid @enderror" name="tgl_mulai"
                                    value="{{ $diskon->tgl_mulai }}" required autocomplete="tgl_mulai" autofocus>
                                @error('tgl_mulai')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="invalid-feedback">Please, enter your name!</div>
                            </div>
                            <div class="col-12">
                                <label for="yourName" class="form-label">Tanggal Akhir</label>
                                <input id="name" type="date"
                                    class="form-control @error('tgl_akhir') is-invalid @enderror" name="tgl_akhir"
                                    value="{{ $diskon->tgl_akhir }}" required autocomplete="tgl_akhir" autofocus>
                                @error('tgl_akhir')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="invalid-feedback">Please, enter your name!</div>
                            </div>

                            <div class="col-12">
                                <button class="btn btn w-100" style="background-color: #494cf6; color:#FFFFFF"
                                    type="submit">submit</button>
                            </div>
                        </form>

                    </div>
                </div>



            </div>
        </div>
    </div>
@endsection
