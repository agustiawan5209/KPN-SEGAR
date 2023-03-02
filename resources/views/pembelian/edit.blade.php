    @extends('layouts.master')
    @section('content')

    @section('title', 'pengajuan')
    @section('pengajuan', 'active')
    @section('iconss-nav', 'show')

    <main id="main" class="main">

        <div class="pagetitle">
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row align-items-top">
                <div class="col-lg-15">


                    <div class="card">
                        <div class="card-body p-0">
                            <a href="{{ url()->previous() }}" style="align-content: center" class="btn btn-danger">Kembali</a>

                            <center>
                                <h5 style="align-content: center" class="card-title font-weight-bold">Data pembelian</h5>
                                <center>


                                    <!-- Table with stripped rows -->
                                    <table class="table">
                                        <tr>
                                            <x-td colspan='1' class=" text-center font-weight-bold">Status pembelian
                                            </x-td>
                                            <x-td colspan='3' class=" text-left font-weight-bold">
                                                @php
                                                    $status = \App\Models\StatusPembelian::where('pembelian_id',$pembelian->id)->latest()->first();
                                                @endphp
                                                <span class=" badge bg-primary">{{ $status->status }}</span> <br>
                                                Ket: <p>{{ $status->ket }}</p>
                                            </x-td>
                                        </tr>
                                        <tr>
                                            <x-td colspan='1' class=" text-center font-weight-bold">Bukti Transaksi</x-td>
                                            <x-td colspan='3' class=" text-center font-weight-bold">
                                                <img src="{{ asset('bukti_pembelian/' . $pembelian->bukti) }}" class="w-50"
                                                    alt="">
                                            </x-td>
                                        </tr>
                                        <tr>
                                            <x-td colspan='4' class=" text-center font-weight-bold">User</x-td>
                                        </tr>
                                        <tr>
                                            <x-td class="bg-primary text-white text-right">Nama </x-td>
                                            <x-td>: {{ $pembelian->nama }}</x-td>
                                            <x-td class="bg-primary text-white text-right">Email</x-td>
                                            <x-td>: {{ $pembelian->email }}</x-td>

                                        </tr>
                                        <tr>
                                            <x-td class="bg-primary text-white text-right">Alamat</x-td>
                                            <x-td>: {{ $pembelian->alamat }}</x-td>
                                            <x-td class="bg-primary text-white text-right">Nomor HP</x-td>
                                            <x-td>: {{ $pembelian->no_hp }}</x-td>
                                        </tr>
                                        <tr>
                                            <x-td colspan='4' class=" text-center">Detail pembelian</x-td>
                                        </tr>
                                        <tr>
                                            <x-td class="bg-primary text-white text-right">Bank </x-td>
                                            <x-td>: {{ $pembelian->bank }}</x-td>
                                            <x-td class="bg-primary text-white text-right">Tanggal Transaksi</x-td>
                                            <x-td>: {{ $pembelian->tgl_transaksi }}</x-td>

                                        </tr>
                                        <tr>
                                            <x-td class="bg-primary text-white text-right">Potongan</x-td>
                                            <x-td>: {{ Str::currency($pembelian->potongan) }}</x-td>
                                            <x-td class="bg-primary text-white text-right">Sub Total</x-td>
                                            <x-td>: {{ Str::currency($pembelian->sub_total) }}</x-td>
                                        </tr>
                                    </table>
                                    <center>
                                        <h5 style="align-content: center" class="card-title font-weight-bold">Data Detail
                                            Pemesanan</h5>
                                        <center>


                                            <!-- Table with stripped rows -->
                                            <table class="table datatable">
                                                <thead>
                                                    <tr>
                                                        <x-th scope="col sm">No</x-th>
                                                        <x-th scope="col">Nama </x-th>
                                                        <x-th scope="col">Harga</x-th>
                                                        <x-th scope="col">Jumlah</x-th>
                                                        <x-th scope="col">potongan</x-th>
                                                        <x-th scope="col">total</x-th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    @foreach ($pembelian->detailpembelian as $item)
                                                        <tr>
                                                            <x-td>{{ $loop->iteration }}</x-td>
                                                            <x-td>{{ $item->nama_barang }}</x-td>
                                                            <x-td>{{ $item->harga }}</x-td>
                                                            <x-td>{{ $item->jumlah }}</x-td>
                                                            <x-td>{{ Str::currency($item->potongan) }}</x-td>
                                                            <x-td>{{ Str::currency($item->total) }}</x-td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                        </div>
                    </div>
                </div>
            </div> <!-- End Table with stripped rows -->

        </section>
    </main>


        @endsection
