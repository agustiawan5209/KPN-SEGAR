@extends('layouts.master')
@section('content')

@section('title', 'datakepala')
@section('datakepala', 'active')
@section('formss-nav', 'show')

<main id="main" class="main">


    <section class="section">
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row">
            <div class="col-lg-12">


                <div class="card">
                    <div class="card-body  overflow-scroll">
                        <h5 class="card-title">Data </h5>
                        {{-- <p>Add lightweight datatables to your project wix-th using x-the <a href="https://gix-thub.com/fiduswriter/Simple-DataTables" target="_blank">Simple DataTables</a> library. Just add <code>.datatable</code> class name to any table you wish to conver to a datatable</p> --}}
                        {{-- <a href="/data-Anggota/form" type="button" class="btn btn-sm"
                            style="background-color:  #012970; color:#FFFFFF">Tambah</a> --}}
                        <!-- Table wix-th stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <x-th scope="col">No</x-th>
                                    <x-th scope="col">Nama</x-th>
                                    <x-th scope="col">Username</x-th>
                                    <x-th scope="col">Alamat</x-th>
                                    <x-th scope="col">Telp</x-th>
                                    <x-th scope="col">Status</x-th>
                                    <x-th scope="col">Detail</x-th>
                                    <x-th scope="col">Aksi</x-th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $nomor = 1;
                                ?>
                                @foreach ($akun as $data)
                                    <tr>
                                        <x-th> {{ $nomor++ }}</x-th>
                                        <x-td>{{ $data->user->name }}</x-td>
                                        <x-td>{{ $data->user->username }}</x-td>
                                        <x-td>{{ $data->user->alamat }}</x-td>
                                        <x-td>{{ $data->user->telephone }}</x-td>
                                        <x-td>
                                            @if ($data->status == 1)
                                                <a href="{{ route('ubahstatus->anggota', ['id' => $data->id]) }}"
                                                    type="button" class="btn btn-outline-primary btn-sm">Aktif</a>
                                            @elseif ($data->status == 0)
                                                <a href="{{ route('ubahstatus->anggota', ['id' => $data->id]) }}"
                                                    type="button" class="btn btn-outline-danger btn-sm">Non-Aktif</a>
                                            @endif
                                        </x-td>
                                        <x-td>
                                            <a href="{{ route('detail-anggota', ['id'=> $data->id]) }}" type="button"
                                                class="btn btn" style="background-color: #05c36a; color:#FFFFFF"><i
                                                    class="bi bi-eye"></i></a>
                                        </x-td>
                                        <x-td>
                                            <a href="/data-Anggota/edit/{{ $data->user->id }}" type="button"
                                                class="btn btn" style="background-color: #05b3c3; color:#FFFFFF"><i
                                                    class="bi bi-pencil"></i></a>
                                            <a href="/data-Anggota/hapus/{{ $data->user->id }}"
                                                onclick="return confirm('Hapus Data?')" type="button"
                                                class="btn btn-danger"><i class="bi bi-trash delete"></i></a>
                                        </x-td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- End Table wix-th stripped rows -->

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
