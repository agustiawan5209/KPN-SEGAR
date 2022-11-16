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
                <h5 class="card-title text-center pb-0 fs-5">Formulir Peminjaman Barang</h5></br>

                <!-- validation Form Elements -->

                <form id="form-formulir" action="{{ route('Pembelian.store') }}" method="POST" enctype="multipart/form-data"
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
                        <label for="validationCustom01" class="col-sm-2 col-form-label">Nama </label>
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
                        <label for="validationTooltip05" class="col-sm-2 col-form-label">Tgl Pembelian</label>
                        <div class="col-sm-10">
                            <input type="date" id="tgl_pengajuan" name="tgl_pengajuan" value="<?php echo date('Y-m-d'); ?>"
                                readonly class="form-control" required>
                            <div class="invalid-feedback">
                                Harus di isi
                            </div>
                        </div>
                    </div>

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



                    <div class="row g-3 mt-3 border-top pt-2">
                        <div class="row targetDiv" id="div0">
                            <div id="group1" class="fvrduplicate">
                                <center> <label for="validationTooltip06" style="float: center; " col-sm-6
                                        col-form-label>Peminjaman
                                        Barang</label>
                                    <center><br>



                                        <div class="row mb-3">

                                            <div class="col-sm-10">

                                                <input type="hidden" id="datefield2" value=" {{ $inputbarang->id }}"
                                                    name="barangs_id" class="form-control" required readonly>
                                                <div class="invalid-feedback">
                                                    Harus di isi
                                                </div>

                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="validationTooltip05" class="col-sm-2 col-form-label"> Barang
                                                Pinjam</label>
                                            <div class="col-sm-10">
                                                <input type="text" id="datefield2"
                                                    value="{{ $inputbarang->kode }} {{ $inputbarang->jenis_barangs->jenis_barang }} {{ $inputbarang->spesifikasi }}"
                                                    name=" " class="form-control" required readonly>
                                                <div class="invalid-feedback">
                                                    Harus di isi
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="validationTooltip03" class="col-sm-2 col-form-label">jumlah
                                                pinjam</label>
                                            <div class="col-sm-4 d-flex">
                                                <button style=" float :right; background-color:   #23262c; color:#FFFFFF"
                                                    type="button" class="btn btn btn-md" id="btn-minus">-</button>
                                                <input type="text" id="validationTooltip03" name="jumlah_pinjam"
                                                    class="form-control w-25 text-center" required readonly
                                                    value="0">
                                                <button style=" float :right; background-color:   #23262c; color:#FFFFFF"
                                                    type="button" class="btn btn btn-md" id="btn-plus">+</button>
                                                <span class=" text-center" style="margin-left: 5px; margin-top:3px;" >
                                                    {{ $inputbarang->jumlah }} {{ $inputbarang->satuans->nama_satuan }}
                                                </span>
                                                <div class="invalid-feedback">
                                                    Harus di isi
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="validationTooltip05" class="col-sm-2 col-form-label">Total</label>
                                            <div class="col-sm-10">
                                                <input type="text"
                                                    value="{{ $inputbarang->harga }}"
                                                    name="total" id="total" class="form-control" required readonly>
                                                <input type="hidden"
                                                    value="{{ $inputbarang->harga }}"
                                                    id="sub_total" class="form-control" required readonly>
                                                <div class="invalid-feedback">
                                                    Harus di isi
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card-footer">
                                            <button style=" float :right; background-color:   #012970; color:#FFFFFF"
                                                type="submit" id="btnSubmit" class="btn btn btn-sm">Submit</button>
                                        </div>

                </form><!-- End General Form Elements -->
            </div>


        </div>
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

                var btnMinus = document.getElementById("btn-minus");
                var btnPlus = document.getElementById("btn-plus");
                var jumlah = document.getElementById('validationTooltip03');
                var max_jumlah = "{{ $inputbarang->jumlah }}";
                var hasil = parseInt(jumlah.value);
                var count = 1;
                jumlah.max = max_jumlah;
                btnMinus.addEventListener('click', function(e) {
                    e.preventDefault;
                    if (count = 1) {
                        count = 0;
                    } else {
                        count--;
                    }
                    jumlah.value = count;
                    var total = $("#sub_total").val();
                    var nilai = total * jumlah.value;
                    $("#total").val(nilai)
                    console.log(nilai)
                })
                btnPlus.addEventListener('click', function(e) {
                    // e.preventDefault;
                    if (count < max_jumlah) {
                        count++
                    }else{
                        count = max_jumlah;
                    }
                    jumlah.value = count;
                    var total = $("#sub_total").val();
                    var nilai = total * jumlah.value;
                    $("#total").val(nilai)
                    console.log(nilai)

                })
                // $("#btnSubmit").click(function (e) {
                //    var form = $("#form-formulir");
                //    console.log(form.serializeArray())
                //  })
            });
        </script>
    @endsection
