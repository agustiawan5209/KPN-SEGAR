@extends('layouts.master')
@section('content')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



    <script>
        console.log('sdhjfdskfsdfjsdjfksd');
        $("#tgl_pinjam").change(function() {
            console.log('sdfkjndipjgodkgdfgjdfgsdhjfdskfsdfjsdjfksd');
        });
    </script>




    <style>
        input[type="date"] {
            position: relative;
        }

        input[type="date"]::-webkit-calendar-picker-indicator {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            width: auto;
            height: auto;
            color: transparent;
            background: transparent;
        }
    </style>

    <main id="main" class="main overflow-hidden">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Table with hoverable rows</h5>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Katalog Barang</th>
                            <th scope="col">Sisa Barang</th>
                            <th scope="col">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $data = session('keranjang');
                            // dd($data[0]);
                            $no = 1;
                        @endphp
                        @if ($data != null || !empty($data))
                            @for ($i = 0; $i < count($data); $i++)
                                <tr>
                                    <th scope="row">{{ $no++ }}</th>
                                    <td> {{ $data[$i][0]['barang_id']->kode }}
                                        {{ $data[$i][0]['barang_id']->jenis_barangs->jenis_barang }}
                                        {{ $data[$i][0]['barang_id']->nama_barang }} </td>
                                    <td>
                                        @if ($data[$i][0]['barang_id']->jumlah <= 0)
                                            <span class="badge bg-danger">
                                                kosong</span>
                                        @else
                                            {{ $data[$i][0]['barang_id']->jumlah }}
                                            {{ $data[$i][0]['barang_id']->satuans->nama_satuan }}
                                        @endif
                                    </td>
                                    <td>
                                        <form action="#" id="Quantity" class="col-sm-4 d-flex">
                                            <input type="hidden" name="id_cart" value="{{ $data[$i][0]['barang_id']->id }}">
                                            <button style=" float :right; background-color:   #23262c; color:#FFFFFF"
                                                type="button" class="btn btn btn-md" id="btn-minus">-</button>
                                            {{-- id Cart --}}
                                            {{-- Jumlah Value --}}
                                            <input type="text" id="validationTooltip03"
                                                max="{{ $data[$i][0]['barang_id']->jumlah }}" name="jumlah_pinjam"
                                                class="form-control w-50 text-center" required
                                                value="{{ $data[$i][0]['quantity'] }}">
                                            {{-- BTN PLUS --}}
                                            <button style=" float :right; background-color:   #23262c; color:#FFFFFF"
                                                type="button" class="btn btn btn-md" id="btnplus">+</button>
                                        </form>
                                        {{-- <span class=" text-center" style="margin-left: 5px; margin-top:3px;" >
                                                {{ $inputbarang->jumlah }} {{ $inputbarang->satuans->nama_satuan }} --}}
                                        </span>
                                    </td>
                                </tr>
                            @endfor
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-center pb-0 fs-5">Formulir Peminjaman Barang</h5></br>

                <!-- validation Form Elements -->

                <form id="form-formulir" action="{{ route('inputpinjam') }}" method="POST" enctype="multipart/form-data"
                    class=" needs-validation" novalidate>
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




                    <fieldset class="row mb-3">
                        <legend class="col-form-label col-sm-2 pt-0">Jenis Peminjaman</legend>
                        <div class="col-sm-10">

                            <input class="form-check-input" type="radio" name="jenis_peminjaman" name="gridRadios"
                                id="gridRadios1" value="Pribadi" checked>
                            <label class="form-check-label" for="gridRadios1">
                                Pribadi
                            </label>
                            <input class="form-check-input" type="radio" name="jenis_peminjaman" name="gridRadios"
                                id="gridRadios2" value="Keperluan Projek">
                            <label class="form-check-label" for="gridRadios2">
                                Keperluan Projek
                            </label>
                        </div>
                    </fieldset>


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

                    {{-- <div class="row mb-3">
                        <label for="validationTooltip03" class="col-sm-2 col-form-label">Surat Pengantar</label>
                        <div class="col-sm-10">
                            <input type="file" id="validationTooltip03" name="bukti_pinjam" class="form-control"required>
                            <div class="invalid-feedback">
                                Harus di isi
                            </div>
                        </div>
                    </div> --}}

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Keterangan</label>
                        <div class="col-sm-10">
                            <input type="text" id=" " name="ket" class="form-control" required
                                placeholder=" isi keterangan">

                        </div>
                    </div>
                    <div class="row mb-3">
                        {{-- <label for="validationTooltip04" class="col-sm-2 col-form-label">Status Konfirmasi</label> --}}
                        <div class="col-sm-10">
                            <input type="hidden" id="validationTooltip04" value="4" name="status_konfirmasis_id"
                                class="form-control"required>
                            <div class="invalid-feedback">
                                Harus di isi
                            </div>
                        </div>
                    </div>
                </form><!-- End General Form Elements -->
            </div>
        </div>
    </main>
    <script>
        $(document).ready(function() {
            var today = new Date();
            var dd = today.getDate();
            var mm = today.getMonth() + 1; //January is 0!
            var yyyy = today.getFullYear();
            if (dd < 10) {
                dd = '0' + dd
            }
            if (mm < 10) {
                mm = '0' + mm
            }

            today = yyyy + '-' + mm + '-' + dd;
            document.getElementById("datefield2").setAttribute("min", today);
            let quantityInputs = document.querySelectorAll('#btnplus');
            let quantityInputsMinus = document.querySelectorAll('#btn-minus');
            let jumlah = document.querySelectorAll('#validationTooltip03');
            var count = 1;
            for (let i = 0; i < quantityInputs.length; i++) {

                let input = quantityInputs[i]
                let inputMinus = quantityInputsMinus[i]
                var jumlahM = jumlah[i]
                input.addEventListener('click', function(param) {
                    var max = inputMinus.parentElement.jumlah_pinjam.max;
                    // console.log(max)

                    if (count < max) {
                        count++;
                    } else if (count >= max) {
                        count = max;
                    }
                    inputMinus.parentElement.jumlah_pinjam.value = count;
                    var id = inputMinus.parentElement.jumlah_pinjam.id_cart;
                    var urlg = "{{ route('keranjang-update', ['id' => 1]) }}";
                    $.ajax({
                        type: "GET",
                        url: urlg,
                        data: "1",
                        success: function(response, status, data) {
                            console.log(response)
                            // console.log(status)
                            // console.log(data)
                        }
                    });
                });
                inputMinus.addEventListener('click', function(param) {
                    // count--;
                    if (isNaN(count) || count >= 1) {
                        count--;
                    }
                    inputMinus.parentElement.jumlah_pinjam.value = count
                });

            }

            function quantityChanged() {
                console.log(count++)
                jumlahM.value = count
            }
        });
        // $("#btnSubmit").click(function(e) {
        //     var form = $("#form-formulir");
        //     console.log(form.serializeArray())
        // })
    </script>
@endsection
