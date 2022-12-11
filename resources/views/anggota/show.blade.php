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
                        <!-- Table wix-th stripped rows -->
                        <table class="table">
                            <tr>
                                <x-th scope="col">Nama</x-th>
                                <x-th scope="col">Username</x-th>
                                <x-th scope="col">Alamat</x-th>
                                <x-th scope="col">Telp</x-th>
                                <x-th scope="col">Status</x-th>
                            </tr>
                            <tr>
                                <x-td>{{ $data->user->name }}</x-td>
                                <x-td>{{ $data->user->username }}</x-td>
                                <x-td>{{ $data->user->alamat }}</x-td>
                                <x-td>{{ $data->user->telephone }}</x-td>
                                <x-td>
                                    @if ($data->status == 1)
                                        <a href="{{ route('ubahstatus->anggota', ['id' => $data->id]) }}" type="button"
                                            class="btn btn-outline-primary btn-sm">Aktif</a>
                                    @elseif ($data->status == 0)
                                        <a href="{{ route('ubahstatus->anggota', ['id' => $data->id]) }}" type="button"
                                            class="btn btn-outline-danger btn-sm">Non-Aktif</a>
                                    @endif
                                </x-td>
                            </tr>

                        </table>
                        <!-- End Table wix-th stripped rows -->

                        <table class="table">
                            <tr>
                                <x-th scope="col">Jumlah Simpanan</x-th>
                                <x-th scope="col">Jumlah Pinjaman</x-th>
                                <x-th scope="col">Jumlah Angsuran</x-th>
                            </tr>
                            <tr>
                                <x-td>{{ Str::currency($data->simpanan->sum('total')) }}</x-td>
                                <x-td>
                                    <a href="{{ route('listPinjaman-anggota', ['id'=> $data->user->id]) }}" class="btn btn-info">
                                        {{ $data->pinjam->count() }}
                                    </a>
                                </x-td>
                                @foreach ($data->pinjam as $pinjam)
                                    @php
                                        $ans[] = $pinjam->angsuran->count();
                                    @endphp
                                @endforeach
                                <x-td>{{ array_sum($ans) }}</x-td>
                            </tr>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
