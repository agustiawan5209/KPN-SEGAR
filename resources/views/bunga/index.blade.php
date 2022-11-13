@extends('layouts.master')
@section('content')

@section('title', 'databunga')
@section('databunga', 'active')
@section('jenis-nav', 'show')

<main id="main" class="main">
    <div class="row">
        <div class="col-lg-12">


            <div class="card">
                <div class="card-body  overflow-scroll">
                    <h5 class="card-title">Data Master </h5>
                    {{-- <p>Add lightweight datatables to your project with using the <a href="https://github.com/fiduswriter/Simple-DataTables" target="_blank">Simple DataTables</a> library. Just add <code>.datatable</code> class name to any table you wish to conver to a datatable</p> --}}
                    <a href="{{route('JenisBunga.create')}}" type="button" class="btn btn-sm"
                        style="background-color:  #012970; color:#FFFFFF">Tambah</a>
                    <!-- Table with stripped rows -->
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Kode</th>
                                {{-- <th scope="col">Foto</th> --}}
                                <th scope="col">Jumlah Bulan</th>
                                <th scope="col">Bunga</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $nomor = 1;
                            ?>
                            @foreach ($jenis as $data)
                            <tr>
                                <th> {{ $nomor++ }} </th>
                                <td>{{ $data->kode }}</td>
                                <td>{{ $data->jumlah_bulan }}</td>
                                <td>{{ $data->jumlah_bunga }}</td>

                                <td class="d-flex">
                                    <a href="{{route('JenisBunga.edit', ['JenisBunga'=> $data->id])}}" type="button"
                                        class="btn btn-sm" style="background-color: #05b3c3; color:#FFFFFF"><i
                                            class="bi bi-pencil"></i></a>
                                    <form action="{{route('JenisBunga.destroy', ['JenisBunga'=> $data->id])}}"
                                         method="post"
                                        class="">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-trash delete"></i></button>
                                    </form>
                                </td>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                    <!-- End Table with stripped rows -->

                </div>
            </div>

        </div>
    </div>
    </section>
@endsection
