@extends('layouts.master')
@section('content')

@section('title', 'lokasipenempatan')
@section('lokasipenempatan', 'active')
@section('components-nav', 'show')


<main id="main" class="main">

    {{-- <div class="pagetitle">
      <h1>Data Jenis Aset</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
          <li class="breadcrumb-item">Tables</li>
          <li class="breadcrumb-item active">Data</li>
        </ol>
      </nav>
   </div><!-- End Page Title --> --}}
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body  overflow-scroll">
                    <h5 class="card-title">Data Lokasi</h5>
                    {{-- <p>Add lightweight datatables to your project with using the <a href="https://github.com/fiduswriter/Simple-DataTables" target="_blank">Simple DataTables</a> library. Just add <code>.datatable</code> class name to any table you wish to conver to a datatable</p> --}}

                    <!-- Basic Modal -->
                    <button type="button" class="btn btn" style="background-color:  #012970; color:#FFFFFF"
                        data-bs-toggle="modal" data-bs-target="#basicModal" data-whatever="@mdo"
                        href="/datajenisbarang/tambah">
                        Tambah
                    </button>
                    <div class="modal fade" id="basicModal" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" style="text-align: center">Input Lokasi</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">

                                    <!-- FORM INPUT DATA JENIS ASET -->
                                    <form name="inputjenisbarang" action="{{ route('lokasi-create') }}"
                                        method="POST" enctype="multipart/form-data" class="needs-validation"
                                        novalidate>
                                        @csrf
                                        <div class="col-12">
                                            {{-- <label for="inputNanme4" class="form-label">Nama Jenis Aset</label> --}}
                                            <input type="text" class="form-control" name="lantai"
                                                placeholder="Masukan lantai"id="lantai" required>
                                            <input type="text" class="form-control" name="ruangan"
                                                placeholder="Masukan nama Ruangan"id="ruangan" required>
                                            <div class="invalid-feedback">
                                                Harus di isi
                                            </div>
                                        </div>
                                </div>
                                <div class="modal-footer" class="text-center">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn"
                                        style="background-color: #012970; color:#FFFFFF">Save</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div><!-- End Basic Modal--><br> <br />

                    <!--TAMPIL LIST TABEL DATA JENIS ASET-->
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                {{-- <th scope="col">ID</th> --}}
                                <th scope="col">Lantai</th>
                                <th scope="col">Ruangan</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $nomor = 1;
                            ?>
                            @foreach ($lokasi as $data)
                                <tr>
                                    <th> {{ $nomor++ }} </th>
                                    {{-- <td> {{ $data->id}} </td> --}}
                                    <td>{{ $data->lantai }}</td>
                                    <td>{{ $data->ruangan }}</td>
                                    <td>
                                        <!--EDIT DATA JENIS ASET-->
                                        <a href="{{route('lokasi-edit', ['id'=> $data->id])}}" type="button" class="btn btn"
                                            style="background-color: #05b3c3; color:#FFFFFF"><i
                                                class="bi bi-pencil"></i></a>
                                        <a href="{{route('lokasi-delete', ['id'=> $data->id])}}"
                                            onclick="return confirm('Hapus Data?')" type="button"
                                            class="btn btn-danger"><i class="bi bi-trash delete"></i></a>

                                    </td>
                            @endforeach
                            </tr>
                        </tbody>
                    </table>
                    <!-- End Table with stripped rows -->
                </div>
            </div>
        </div>
    </div>
@endsection
