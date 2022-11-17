@extends('customer.layout')
@section('content')
    <!-- Hero Section Begin -->
    <section class="hero-section">
        <div class="hero-items owl-carousel">
            <div class="single-hero-items set-bg" data-setbg="{{asset('img/hero-1.jpg')}}">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5">
                            <span>Peminjaman, Pembelian</span>
                            <h1>KPN SEGAR</h1>
                            <p>
                               Menyediakan Barang Sesuai Kebutuhan Anda
                            </p>
                            <a href="#" class="primary-btn">Beli Sekarang</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="single-hero-items set-bg" data-setbg="{{asset('img/hero-2.jpg')}}">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5">
                            <span>Peminjaman, Pembelian</span>
                            <h1>KPN SEGAR</h1>
                            <p>
                                Menyediakan Peminjaman Dalam Jumlah Bunga Yang Sedikit
                            </p>
                            <a href="#" class="primary-btn">Belanja Sekarang</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Women Banner Section Begin -->
    <section class="women-banner spad">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 mt-5">
                    <div class="product-slider owl-carousel">
                        @foreach ($barang as $item)
                            <div class="product-item">
                                <div class="pi-pic">
                                    <img src="{{ asset('fotobarang/' . $item->foto) }}" alt="" />
                                    <ul>
                                        <li class="w-icon active">
                                            <a href="#"><i class="icon_bag_alt"></i></a>
                                        </li>
                                        <li class="quick-view"><a
                                                href="{{ route('Customer.detail', ['id' => $item->id]) }}">+ Detail</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="pi-text">
                                    <div class="catagory-name">{{ $item->jenis_barangs->jenis_barang }} </div>
                                    <div class="product-price">
                                        Rp. {{ $item->harga }}
                                        @if ($item->diskon != null)
                                            <span>{{$item->diskon->diskon}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Women Banner Section End -->
@endsection
