@extends('layouts.master')
@section('title', 'potongan-nav')
@section('voucherli', 'active')
@section('potongan-nav', 'show')
@section('content')


<main id="main" class="main">

    <div class="row">
        <div class="col-lg-12">


            <div class="card">
                <div class="card-body  overflow-scroll">
                    <h5 class="card-title">Data Voucher</h5>
                    {{-- <p>Add lightweight datatables to your project with using the <a href="https://github.com/fiduswriter/Simple-DataTables" target="_blank">Simple DataTables</a> library. Just add <code>.datatable</code> class name to any table you wish to conver to a datatable</p> --}}
                    <a href="{{ route('Voucher.create') }}" type="button" class="btn btn-sm"
                        style="background-color:  #012970; color:#FFFFFF">Tambah</a>
                    <!-- Table with stripped rows -->
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">kode</th>
                                <th scope="col">Potongan</th>
                                <th scope="col">Tanggal Mulai</th>
                                <th scope="col">Tanggal Berakhir</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $nomor = 1;
                            ?>
                            @foreach ($voucher as $data)
                            <tr>
                                <th> {{ $loop->iteration }} </th>
                                <td>{{ $data->kode }}</td>
                                <td>{{ $data->potongan }}</td>
                                <td>{{ $data->tgl_mulai }}</td>
                                <td>{{ $data->tgl_akhir }}</td>
                                <td>
                                    <a href="{{ route('Voucher.edit', ['id'=> $data->id]) }}}}" type="button"
                                        class="btn btn-sm" style="background-color: #05b3c3; color:#FFFFFF"><i
                                            class="bi bi-pencil"></i></a>
                                    <a href="{{ route('Voucher.destroy', ['id'=> $data->id]) }}}}"
                                        onclick="return confirm('Hapus Data?')" type="button"
                                        class="btn btn-danger btn-sm"><i class="bi bi-trash delete"></i></a>
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
