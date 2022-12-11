@extends('customer.layout')
@section('content')
    <div class="related-products spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Semua Produk</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($barang as $item)
                    <div class="col-lg-3 col-sm-6 shadow" >
                        <div class="product-item">
                            <div class="pi-pic">
                                <img src="{{ asset('fotobarang/' . $item->foto) }}" alt="" />
                                <ul>
                                    <li class="w-icon active">
                                        <a href="{{ route('keranjang.create', ['barang_id' => $item->id]) }}"><i
                                                class="icon_bag_alt"></i></a>
                                    </li>
                                    <li class="quick-view">
                                        <a
                                        href="{{ route('Customer.detail', ['id' => $item->id]) }}">+ Detail</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="pi-text">
                                <div class="catagory-name">{{ $item->jenis_barangs->jenis_barang }}</div>
                                <a href="#">
                                    <h5>{{ $item->jenis_barangs->jenis_barang }}</h5>
                                </a>
                                <p>{{ $item->ket }}</p>
                                <div class="product-price">
                                    Rp. {{ $item->harga }}
                                    @if ($item->diskon != null)
                                        <span>{{ $item->diskon->diskon }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
