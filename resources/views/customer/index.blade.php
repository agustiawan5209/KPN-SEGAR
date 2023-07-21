@extends('customer.layout')
@section('content')
    <!-- Hero Section Begin -->
    <section class="hero-section container h-75">
        <div class="hero-items owl-carousel">
            <div class="single-hero-items set-bg" data-setbg="{{asset('img/hero-1.jpg')}}">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5">
                            <span class="text-dark">Peminjaman, Pembelian</span>
                            <h1>KPN SEGAR</h1>
                            <p>
                               Menyediakan Barang Sesuai Kebutuhan Anda
                            </p>
                            <a href="{{route('Pembelian.cekdata')}}" class="btn-info px-3 py-2 rounded" >Belanja Sekarang</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="single-hero-items set-bg" data-setbg="{{asset('img/hero-2.jpg')}}">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5">
                            <span class="text-dark">Peminjaman, Pembelian</span>
                            <h1>KPN SEGAR</h1>
                            <p>
                                Menyediakan Peminjaman Dalam Jumlah Bunga Yang Sedikit
                            </p>
                            @if (Auth::user()->anggota != null)

                            <a href="{{route('dashboardUser')}}" class="btn-info px-3 py-2 rounded">Daftar Jadi Anggota</a>
                            @else
                            <a href="{{route('daftar-anggota')}}" class="btn-info px-3 py-2 rounded">Daftar Jadi Anggota</a>
                            @endif
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
                <div class="col-lg-12 ">
                    <h3 class="text-center"><span>Produk Terbaru</span></h3>
                    <div class="product-slider owl-carousel">
                        @foreach ($barang as $item)
                            <div class="product-item">
                                <div class="pi-pic">
                                    <img src="{{ asset('fotobarang/' . $item->foto) }}" alt="" />
                                    <ul>
                                        <li class="w-icon active">
                                            <a href="{{ route('keranjang.create', ['barang_id'=> $item->id]) }}"><i class="icon_bag_alt"></i></a>
                                        </li>
                                        <li class="quick-view"><a
                                                href="{{ route('Customer.detail', ['id' => $item->id]) }}">+ Detail</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="pi-text">
                                    <div class="catagory-name">{{ $item->jenis_barangs->jenis_barang }} </div>
                                    <a href="#">
                                        <h5>{{ $item->jenis_barangs->jenis_barang }}</h5>
                                    </a>
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
