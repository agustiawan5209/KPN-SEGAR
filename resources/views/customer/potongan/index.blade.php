@extends('customer.layout')
@section('content')
    <div class="container">
        <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
            <h1 class="display-4">Promo</h1>
            <p class="lead">Promo Potongan harga dan potongan diskon</p>
        </div>
        <div class="container">
            <div class="card-deck mb-3 text-center">
                @foreach ($promo as $promo)
                    <div class="card mb-4 box-shadow">
                        <div class="card-header">
                            <h4 class="my-0 font-weight-normal">Kode Promo : {{ $promo->kode }}</h4>
                        </div>
                        <div class="card-body">
                            <h1 class="card-title pricing-card-title"> <span class="text-md-center"
                                    style="font-size: 18px;">Potongan</span>
                                @if ($promo->jenis_promo == 1)
                                    Rp.
                                    @endif {{ $promo->potongan }} @if ($promo->jenis_promo == 2)
                                        <small class="text-muted">%</small>
                                    @endif
                            </h1>
                            <ul class="list-unstyled mt-3 mb-4">
                                <li>Kadaluarsa Pada Tanggal : {{ $promo->tgl_akhir }}</li>
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="container">
        <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
            <h1 class="display-4">Voucher</h1>
            <p class="lead">Klaim Kode Voucher Untuk Potongan Harga Produk Kami</p>
        </div>
        <div class="container">
            <div class="card-deck mb-3 text-center">
                @foreach ($voucher as $voucher)
                    <div class="card mb-4 box-shadow">
                        <div class="card-header">
                            <h4 class="my-0 font-weight-normal">Kode Vouhcer :{{ $voucher->kode }}</h4>
                        </div>
                        <div class="card-body">
                            <h1 class="card-title pricing-card-title"> <span class="text-md-center"
                                    style="font-size: 18px;">Potongan</span>
                                            {{ $voucher->potongan }}
                                        <small class="text-muted">%</small>
                            </h1>
                            <ul class="list-unstyled mt-3 mb-4">
                                @if ($voucher->jenis_voucher == 1)
                                    <li>Voucher Untuk Pengguna Baru</li>
                                    <li>Undang Teman Anda Dan Klaim Vouchernya</li>
                                @elseif($voucher->jenis_voucher == 2)
                                    <li>Beli Produk : {{ $voucher->barang->nama_barang }}</li>
                                    <li>Untuk Dapatkan Penawaran Harga</li>
                                @elseif($voucher->jenis_voucher == 3)
                                <li>Klaim Voucher Sekarang</li>
                                @endif
                                <li>Kadaluarsa Pada Tanggal : {{ $voucher->tgl_akhir }}</li>
                            </ul>
                            @if ($voucher->jenis_voucher != 1)
                                <a href="{{ route('Klaim-Voucher', ['voucher_id'=> $voucher->id]) }}" class="btn btn-lg btn-block btn-primary">Klaim Sekarang Juga</a>
                            @endif

                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
