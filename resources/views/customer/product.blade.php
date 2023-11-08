@extends('customer.layout')
@section('content')

    <!-- Product Shop Section Begin -->
    <section class="product-shop spad page-details">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6 ">
                            <div class="product-pic-zoom">
                                <img class="product-big-img h-50" src="{{asset('fotobarang/'.$barang->foto)}}" alt="" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="product-details">
                                <div class="pd-title">
                                    <span>Katalog :{{$barang->jenis_barangs->jenis_barang}}</span>
                                    <h3>{{$barang->nama_barang}}</h3>
                                </div>
                                <div class="pd-desc">

                                    <p>Satuan : {{$barang->satuans->nama_satuan}}</p>
                                    @php
                                        $harga = 0;
                                        if($barang->diskon == null){
                                            $harga = $barang->harga;
                                        }else{
                                            $harga = $barang->harga * ($barang->diskon->diskon /100);
                                        }
                                    @endphp
                                    <h4>Harga : Rp. {{number_format($barang->harga,0,2)}} @if ($barang->diskon !== null)
                                         <span>{{ $harga }}</span>
                                    @endif</h4>
                                    <br>
                                    {{-- @if ($barang->diskon !== null)
                                    <h6 class="text-danger">Diskon {{ $barang->diskon->diskon }}%</h6>
                                    @endif --}}
                                        <br>
                                        <h6>Deskripsi Produk :</h6>
                                    <p>
                                        {{$barang->ket}}
                                    </p>
                                </div>
                                <div class="quantity">
                                    <a href="{{route('keranjang.create', ['barang_id'=> $barang->id])}}" class="primary-btn pd-cart border-right">Keranjang</a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Shop Section End -->

    <!-- Related Products Section End -->
    <div class="related-products spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2 class=" border-bottom">Rekomendasi Barang</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($relate_barang as $item)
                    <div class="col-lg-3 col-sm-6">
                        <div class="product-item">
                            <div class="pi-pic">
                                <img src="{{asset('fotobarang/'.$item->foto)}}" alt="" />
                                <ul>
                                    <li class="w-icon active">
                                        <a href="#"><i class="icon_bag_alt"></i></a>
                                    </li>
                                    <li class="quick-view"><a href="{{ route('Customer.detail', ['id'=> $item->id]) }}">+ Detail</a></li>
                                </ul>
                            </div>
                            <div class="pi-text">
                                <div class="catagory-name">{{ $item->nama_barang }}</div>
                                <a href="#">
                                    <h5>{{ $item->jenis_barangs->jenis_barang }}</h5>
                                </a>
                                <div class="product-price">
                                    {{ number_format($item->harga,0,2) }}
                                    @if ($item->diskon !== null)
                                        <span>{{ ($item->harga * ($item->diskon->diskon / 100)) }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Related Products Section End -->

@endsection
