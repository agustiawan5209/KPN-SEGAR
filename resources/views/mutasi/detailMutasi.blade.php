@extends('layouts.master')
@section('content')

@section('title', 'mutasi Detail')
{{-- @section('mutasi', 'active') --}}
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
                            Data Mutasi {{$barang->kode}}/{{$barang->spesifikasi}}
                        </h5>
                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>

                                    <th scope="col">No</th>
                                    <th scope="col">Kode Mutasi</th>
                                    <th scope="col">Tanggal Mutasi</th>
                                    <th scope="col">Barang</th>
                                    {{-- <th scope="col">Jenis Aset</th> --}}
                                    <th scope="col">Lokasi Awal</th>
                                    <th scope="col">Keterangan</th>
                                    {{-- <th scope="col">Aksi</th> --}}
                                </tr>
                            </thead>

                            <tbody>
                                {{-- <form action="#" id="form"> --}}
                                @foreach ($mutasi as $item)
                                    <tr>
                                        <td>
                                            {{ $loop->iteration }}
                                            {{-- <input type="checkbox" checked name="check" id="check">
                                                <input type="text" name="id" id="d{{ $item->id }}"
                                                    value="{{ $item->id }}"> --}}
                                        </td>
                                        <td>
                                            {{ $item->kode }}
                                        </td>
                                        <td>{{ $item->tgl_mutasi }}</td>
                                        <td>{{ $item->barangs->kode }}{{ $item->barangs->spesifikasi }}</td>
                                        {{-- <td>{{ $item->barangs->jenis_asets->nama_jenisaset }}</td> --}}
                                        <td>{{ $item->dari }}</td>

                                        <td>{{ $item->ket }}</td>
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
    </section>
@endsection
