@extends('customer.layout')
@section('content')

@section('title', 'asetbergerak')
@section('asetbergerak', 'active')
@section('forms-nav', 'show')

<main id="main" class="main">

    <div class="pagetitle">

    </div><!-- End Page Title -->

    <section class="container-fluid py-3 pb-5">
        <div class="row">
           @foreach ($inputbarang as $item)
             <div class="card col-lg-3" >
                 <img src="{{ asset('fotobarang/' . $item->foto) }}" class="card-img-top" alt="...">
                 <div class="card-body">
                     <h5 class="card-title">{{ $item->jenis_barangs->jenis_barang }}</h5>
                     <p class="card-text">
                        Rp. {{ $item->harga }}
                        @if ($item->diskon != null)
                            <span>{{$item->diskon->diskon}}</span>
                        @endif
                     </p>
                     <a href="{{ route('Customer.detail', ['id' => $item->id]) }}" class="primary-btn">Detail</a>
                 </div>
             </div>
           @endforeach
        </div>

        </div>
        </div>
    </section>
@endsection
