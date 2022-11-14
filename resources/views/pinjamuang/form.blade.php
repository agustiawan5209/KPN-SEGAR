@extends('layouts.master')
@section('content')
    <main id="main" class="main overflow-hidden">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-center pb-0 fs-5">Formulir Peminjaman Barang</h5></br>
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
                <!-- validation Form Elements -->

                <form id="form-formulir" action="{{route('pinjamUang.store')}}" method="POST" enctype="multipart/form-data" class=" needs-validation"
                    novalidate>
                    @csrf

                    <div class="row mb-3">
                        {{-- <label for="validationCustom01" class="col-sm-2 col-form-label">Nama login</label> --}}
                        <div class="col-sm-10">


                            <input type="hidden" id="validationCustom01" name="users_id" value=" {{ auth()->user()->id }}"
                                class="form-control" required readonly>


                            <div class="invalid-feedback">
                                Harus di isi
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="validationCustom01" class="col-sm-2 col-form-label">Nama Peminjam</label>
                        <div class="col-sm-10">
                            <input type="text" id="validationCustom01" name="nama_peminjam"
                                value=" {{ auth()->user()->name }}" readonly class="form-control" required
                                placeholder=" nama peminjam">
                            <div class="invalid-feedback">
                                Harus di isi
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="validationTooltip02" class="col-sm-2 col-form-label"> Tujuan Pinjam </label>
                        <div class="col-sm-10">
                            <input type="text" id="validationTooltip02" name="tujuan" class="form-control" required
                                placeholder=" ex. untuk keperluan proyek A, untuk mengantar keluarga">
                            <div class="invalid-feedback">
                                Harus di isi
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="validationTooltip02" class="col-sm-2 col-form-label"> Jumlah Pinjaman </label>
                        <div class="col-sm-10">
                            <input type="text" id="validationTooltip02" name="jumlah_pinjam" id="jumlah_pinjam"
                                class="form-control jumlah_pinjam" required
                                placeholder=" ex. untuk keperluan proyek A, untuk mengantar keluarga">
                            <div class="invalid-feedback">
                                Harus di isi
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="validationTooltip02" class="col-sm-2 col-form-label"> Lama Pinjaman </label>
                        <div class="col-sm-10">
                            <select class="form-select" id="jenis_id" name="jenis_id" id="validationTooltip06"
                                aria-label="Default select example" required>
                                <option value="">--</option>
                                @foreach ($jenis as $item)
                                    <option value="{{ $item->id }}">{{ $item->jumlah_bulan }} Bulan</option>
                                @endforeach
                            </select>
                            <input type="hidden" name="total_bunga" class="total_bunga">
                            <div class="invalid-feedback">
                                Harus di isi
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-5">
                            <table class="table col-md-3">
                                <thead>
                                    <tr>
                                        <th>Lama Pinjam</th>
                                        <th>Jumlah Bunga</th>
                                    </tr>
                                </thead>
                                <tbody id="hasilPinjam">

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="validationTooltip05" class="col-sm-2 col-form-label">Tgl Pengajuan</label>
                        <div class="col-sm-10">
                            <input type="date" id="tgl_pengajuan" name="tgl_pengajuan" value="<?php echo date('Y-m-d'); ?>"
                                readonly class="form-control" required>
                            <div class="invalid-feedback">
                                Harus di isi
                            </div>
                        </div>
                    </div>


                    <div class="row mb-3">
                        <label for="validationTooltip05" class="col-sm-2 col-form-label">Tgl Pengembalian</label>
                        <div class="col-sm-10">
                            <input type="date" id="datefield2" name="tgl_kembali" class="form-control" required>
                            <div class="invalid-feedback">
                                Harus di isi
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="validationTooltip05" class="col-sm-2 col-form-label">Keterangan</label>
                        <div class="col-sm-10">
                            <input type="text" id="datefield2" name="ket" class="form-control" required>
                            <div class="invalid-feedback">
                                Harus di isi
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>

                </form><!-- End General Form Elements -->
            </div>


        </div>
    </main>
    <script>
        $(document).ready(function() {
            $("#jenis_id").on('change', function(e) {

                $.ajax({
                        type: "GET",
                        url: "/pinjamuang/find/" + $(this).val(),
                        success: function(response) {
                            var hasil = response;
                            var bunga = JSON.stringify(response.jumlah_bunga);
                            var jumlah_pinjam = $('.jumlah_pinjam').val();
                            console.log(bunga)
                            var total_bunga = (parseInt(bunga) / 100) * parseInt(jumlah_pinjam);
                            console.log(total_bunga)
                            $('.total_bunga').val(parseInt(total_bunga))
                            var table = `
                            <tr>
                                <td>${hasil.jumlah_bulan} Bulan</td>
                                <td>${hasil.jumlah_bunga}%</td>
                                <td>${parseInt(total_bunga)}</td>
                            </tr>
                        `;

                            $("#hasilPinjam").append(table)
                        }
                    });

            });
        });
    </script>
@endsection

@section('js')
@endsection
