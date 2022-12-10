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
                            <h5 style="align-content: center" class="card-title">Data Simpanan

                            </h5>
                        </center>
                        <!-- Table with stripped rows -->
                        <table class="table datatable" id="peminjaman">
                            <thead>
                                <tr>
                                    <x-th scope="col sm">No</x-th>
                                    <x-th scope="col">Kode </x-th>
                                    <x-th scope="col">Tanggal Simpanan </x-th>
                                    <x-th scope="col">Kredit </x-th>
                                    <x-th scope="col">Debit</x-th>
                                    <x-th scope="col">Total</x-th>

                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($simpan as $data)
                                    <tr role="row">
                                        <x-td>{{ $loop->iteration }}</x-td>
                                        <x-td> {{ $data->kode_simpanan }}</x-td>
                                        <x-td>{{ $data->tgl_simpanan }}</x-td>
                                        <x-td>{{ Str::currency($data->kredit) }}</x-td>
                                        <x-td>{{ Str::currency($data->debit) }}</x-td>
                                        <x-td>{{ Str::currency($data->total) }}</x-td>
                                        @php
                                            $total[] = $data->total;
                                        @endphp
                                    </tr>
                                @endforeach
                                <tr>
                                    <x-td colspan='5'>Total</x-td>
                                    <x-td colspan='1'>{{ Str::currency(array_sum($total)) }}</x-td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> <!-- End Table with stripped rows -->

        </div>
        </div>


    @endsection
