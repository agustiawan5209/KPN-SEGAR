@extends('customer.layout')
@section('content')
    <section class="shopping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="cart-table">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Foto</th>
                                            <th class="p-name text-center">Nama Produk</th>
                                            <th>Harga</th>
                                            <th>Hapus</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $sub_total = array();
                                        @endphp
                                        @foreach ($keranjang as $item)
                                            <tr>
                                                <td class="cart-pic first-row">
                                                    <img src="{{ asset('fotobarang/' . $item->foto) }}">
                                                </td>
                                                <td class="cart-title first-row text-center">
                                                    <h5>{{ $item->nama_barang }}</h5>
                                                </td>
                                                <td class="p-price first-row">{{ $item->harga }}</td>
                                                <td class="delete-item"><a
                                                        href="{{ route('keranjang.destroy', ['id' => $item->id]) }}"><i
                                                            class="fa fa-close">
                                                        </i></a></td>
                                            </tr>
                                            @php
                                                $sub_total[] = $item->sub_total;
                                            @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <h4 class="mb-4">
                                Informasi Pembeli:
                            </h4>
                            <div class="user-checkout">
                                <form>
                                    <div class="form-group">
                                        <label for="namaLengkap">Nama lengkap</label>
                                        <input type="text" class="form-control" id="namaLengkap"
                                            aria-describedby="namaHelp" placeholder="Masukan Nama">
                                    </div>
                                    <div class="form-group">
                                        <label for="namaLengkap">Email Address</label>
                                        <input type="email" class="form-control" id="emailAddress"
                                            aria-describedby="emailHelp" placeholder="Masukan Email">
                                    </div>
                                    <div class="form-group">
                                        <label for="namaLengkap">No. HP</label>
                                        <input type="text" class="form-control" id="noHP"
                                            aria-describedby="noHPHelp" placeholder="Masukan No. HP">
                                    </div>
                                    <div class="form-group">
                                        <label for="alamatLengkap">Alamat Lengkap</label>
                                        <textarea class="form-control" id="alamatLengkap" rows="3"></textarea>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="proceed-checkout">
                                <ul>
                                    <li class="subtotal">ID Transaction <span>#SH12000</span></li>
                                    <li class="subtotal mt-3">Subtotal <span>{{ Str::currency(array_sum($sub_total)) }}</span></li>
                                    <li class="subtotal mt-3">Pajak <span>10%</span></li>
                                    @php
                                        $pajak = array_sum($sub_total) / 10;
                                        $total_biaya = array_sum($sub_total) + $pajak;
                                    @endphp
                                    <li class="subtotal mt-3">Total Biaya <span>{{ Str::currency($total_biaya) }}</span></li>
                                    <li class="subtotal mt-3">Bank Transfer <span>Mandiri</span></li>
                                    <li class="subtotal mt-3">No. Rekening <span>2208 1996 1403</span></li>
                                    <li class="subtotal mt-3">Nama Penerima <span>KPN SEGAR</span></li>
                                </ul>
                                <a href="success.html" class="proceed-btn">Lanjutkan</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
