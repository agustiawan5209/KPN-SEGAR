@extends('customer.layout')
@section('content')
    <section class="shopping-cart spad">
        <div class="container">
            <x-validation-errors />
            <form action="{{ route('Pembelian.store') }}" method="POST" enctype="multipart/form-data" class="row">
                @csrf
                @method('POST')
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
                                            <th>Jumlah</th>
                                            <th>Total</th>
                                            <th>Hapus</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $sub_total = [];
                                        @endphp
                                        @foreach ($keranjang as $item)
                                            <tr class="itemcart">
                                                <td class="cart-pic first-row">
                                                    <input type="hidden" name="keranjang[]" id="keranjang_id" value="{{ $item->id }}">
                                                    <img src="{{ asset('fotobarang/' . $item->foto) }}">
                                                </td>
                                                <td class="cart-title first-row text-center">
                                                    <h5>{{ $item->nama_barang }}</h5>
                                                </td>
                                                <td class="p-price first-row">
                                                    <input type="text" class="item-harga" readonly value="{{ $item->harga }}">
                                                </td>
                                                <td class=" first-row qua-col">
                                                    <div class="quantity pro-qty">
                                                        <input type="text" class="pro-qty input-qty" name="jumlah[]" value="{{ $item->jumlah }}">
                                                    </div>
                                                </td>
                                                <td class="p-price first-row total-price">
                                                    <input type="text" class="total-price" readonly name="sub_total[]" value="{{ $item->sub_total }}">
                                                </td>
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
                                <div>
                                    <div class="form-group">
                                        <label for="namaLengkap">Nama lengkap</label>
                                        <input type="text" class="form-control" id="namaLengkap"
                                            aria-describedby="namaHelp" placeholder="Masukan Nama" name="nama">
                                    </div>
                                    <div class="form-group">
                                        <label for="namaLengkap">Email Address</label>
                                        <input type="email" class="form-control" id="emailAddress"
                                            aria-describedby="emailHelp" placeholder="Masukan Email" name="email">
                                    </div>
                                    <div class="form-group">
                                        <label for="namaLengkap">No. HP</label>
                                        <input type="text" class="form-control" id="noHP"
                                            aria-describedby="noHPHelp" placeholder="Masukan No. HP" name="no_hp">
                                    </div>
                                    <div class="form-group">
                                        <label for="alamatLengkap">Alamat Lengkap</label>
                                        <textarea class="form-control" id="alamatLengkap" rows="3" name="alamat"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="namaLengkap">Tanggal Transaksi</label>
                                        <input type="date" class="form-control" id="tgl" aria-describedby="tglHelp"
                                            readonly value={{ \Carbon\Carbon::now()->format('Y-m-d') }}
                                            name="tgl_transaksi">
                                    </div>
                                    <div class="form-group">
                                        <label for="namaLengkap">Bukti Transaksi</label>
                                        <input type="file" class="form-control" id="bukti"
                                            aria-describedby="buktiHelp" name="bukti">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="proceed-checkout">
                                <ul>
                                    <li class="subtotal">ID Transaction <span>{{ $kode }}</span></li>
                                    <li class="subtotal mt-3">Subtotal
                                        <span>{{ Str::currency(array_sum($sub_total)) }}</span></li>
                                    <li class="subtotal mt-3">Pajak <span>10%</span></li>
                                    @php
                                        $pajak = array_sum($sub_total) / 10;
                                        $total_biaya = array_sum($sub_total) + $pajak;
                                    @endphp
                                    <li class="subtotal mt-3">Total Biaya <span>{{ Str::currency($total_biaya) }}</span>
                                    </li>
                                    <input type="hidden" name="sub_total" value="{{ $total_biaya }}">
                                    <li class="subtotal mt-3">Bank Transfer <span>Mandiri</span></li>
                                    <li class="subtotal mt-3">No. Rekening <span>2208 1996 1403</span></li>
                                    <li class="subtotal mt-3">Nama Penerima <span>KPN SEGAR</span></li>
                                </ul>
                                <button type="submit" class="proceed-btn">Lanjutkan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
