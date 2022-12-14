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
                        @can('Bendahara')
                        <a href="{{ route('simpanan.create' ,['kode_anggota'=> $kode_anggota]) }}" class="btn btn-info" >Tambah</a>
                        @endcan
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
                                    <x-th scope="col">Debit</x-th>
                                    <x-th scope="col">Kredit </x-th>
                                    <x-th scope="col">Total</x-th>
                                    @can('Bendahara')
                                    <x-th scope="col">Aksi</x-th>
                                    @endcan

                                </tr>
                            </thead>

                            <tbody>
                                @php
                                    $total =array();
                                    $debit =array();
                                    $kredit =array();
                                @endphp
                                @foreach ($simpan as $data)
                                    <tr role="row">
                                        <x-td>{{ $loop->iteration }}</x-td>
                                        <x-td> {{ $data->kode_simpanan }}</x-td>
                                        <x-td>{{ $data->tgl_simpanan }}</x-td>
                                        <x-td>{{ Str::currency($data->debit) }}</x-td>
                                        <x-td>{{ Str::currency($data->kredit) }}</x-td>
                                        <x-td>{{ Str::currency($data->total) }}</x-td>
                                        @php
                                            $total[] = $data->total;
                                            $kredit[] = $data->kredit;
                                            $debit[] = $data->debit;
                                        @endphp
                                        @can('Bendahara')
                                        <td>
                                            <!--EDIT DATA JENIS ASET-->
                                            <a href="{{route('simpanan.edit', ['id'=> $data->id])}}" type="button" class="btn btn"
                                                style="background-color: #05b3c3; color:#FFFFFF"><i
                                                    class="bi bi-pencil"></i></a>
                                            <a href="{{route('simpanan.destroy', ['id'=> $data->id])}}"
                                                onclick="return confirm('Hapus Data?')" type="button"
                                                class="btn btn-danger"><i class="bi bi-trash delete"></i></a>

                                        </td>
                                        @endcan
                                    </tr>
                                @endforeach
                                <tr>
                                    <x-td colspan='3'>Total</x-td>
                                    <x-td colspan='1'>{{ Str::currency(array_sum($debit)) }}</x-td>
                                    <x-td colspan='1'>{{ Str::currency(array_sum($kredit)) }}</x-td>
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
