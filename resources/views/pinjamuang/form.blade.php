@extends('layouts.master')
@section('content')
    <main id="main" class="main overflow-hidden">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-center pb-0 fs-5">Formulir Peminjaman Barang</h5></br>

                <!-- validation Form Elements -->

                <form id="form-formulir" action="{{ route('pinjamUang.store') }}" method="POST" enctype="multipart/form-data"
                    class=" needs-validation" novalidate>
                    @csrf
                    <x-validation-errors />
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
                            <select name="kode_anggota" id="" class="form-select">
                                <option value="">---</option>
                                @foreach ($user as $anggota)
                                    <option value="{{ $anggota->kode_anggota }}">{{ $anggota->kode_anggota }} - @if ($anggota->user != null)
                                            {{ $anggota->user->name }}
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Harus di isi
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="validationTooltip02" class="col-sm-2 col-form-label"> Jumlah Pinjaman </label>
                        <div class="col-sm-10">
                            <input type="number" id="validationTooltip02" name="jumlah_pinjam" id="jumlah_pinjam"
                                class="form-control jumlah_pinjam" required placeholder="0000000000">
                            <div class="invalid-feedback">
                                Harus di isi
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="validationTooltip05" class="col-sm-2 col-form-label">Tgl Pengajuan</label>
                        <div class="col-sm-10">
                            <input type="date" id="tgl_pengajuan" name="tgl_pengajuan" value="<?php echo date('Y-m-d'); ?>"
                                class="form-control" required>
                            <div class="invalid-feedback">
                                Harus di isi
                            </div>
                        </div>
                    </div>


                    <div class="row mb-3">
                        <label for="validationTooltip05" class="col-sm-2 col-form-label">Tgl Pengembalian</label>
                        <div class="col-sm-10">
                            <input type="date" id="tgl_kembali" name="tgl_kembali" class="form-control" required>
                            <div class="invalid-feedback">
                                Harus di isi
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="validationTooltip02" class="col-sm-2 col-form-label"> Lama Pinjaman </label>
                        <div class="col-sm-10">
                            <input type="text" id="lama_pinjam" name="lama_pinjam" class="form-control" readonly
                                required>

                            <div class="invalid-feedback">
                                Harus di isi
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="validationTooltip02" class="col-sm-2 col-form-label"> Bunga </label>
                        <div class="col-sm-10">
                            <input type="text" id="bunga" name="bunga" class="form-control bunga" required>
                            <div class="invalid-feedback">
                                Harus di isi
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="validationTooltip05" class="col-sm-2 col-form-label">Bukti Pinjaman</label>
                        <div class="col-sm-10">
                            <input type="file" id="datefield2" name="bukti_pinjam" class="form-control" required>
                            <div class="invalid-feedback">
                                Harus di isi
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="validationTooltip05" class="col-sm-2 col-form-label">Jumlah Angsuran</label>
                        <div class="col-sm-10">
                            <input type="number" id="jumlah_angsuran" name="jumlah_angsuran" class="form-control" required>
                            <div class="invalid-feedback">
                                Harus di isi
                            </div>
                        </div>

                        <div class="col-sm-10" id="angsuran_main">
                            <label for="validationTooltip05" class="col-sm-12 col-form-label">Mohon isi Tanggal Angsuran dan
                                jumlah angsuran</label>
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
            $("#angsuran_main").hide();
            $("#jumlah_angsuran").keyup(function(e) {
                $("#angsuran_main").show();

                var angsuran_main = $("#angsuran_main");
                // tgl
                var tgl_angsuran = $(".tgl_angsuran");
                $(tgl_angsuran).remove()
                // jumlah
                var jumlah_angsuran = $(".jumlah_angsuran");
                $(jumlah_angsuran).remove()
                // span
                var spanmain = $("#angsuran_main span");
                $(spanmain).remove()
                var brmain = $("#angsuran_main br");
                $(brmain).remove()
                var jumlah_pinjam = $(".jumlah_pinjam").val();
                var bunga = $("#bunga").val();
                const total_bunga = jumlah_pinjam * (bunga / 100);

                // Tanggal Min Dan Max
                var tgl_min = new Date($("#tgl_pengajuan").val());
                var tgl_max = new Date($("#tgl_kembali").val());
                const day = {
                    min: ("0" + tgl_min.getDate()).slice(-2),
                    max: ("0" + tgl_max.getDate()).slice(-2),
                }
                const month = {
                    min: ("0" + (tgl_min.getMonth() + 1)).slice(-2),
                    max: ("0" + (tgl_max.getMonth() + 1)).slice(-2),
                }
                const year = {
                    min: tgl_min.getFullYear(),
                    max: tgl_max.getFullYear(),
                }
                const min_date = `${year.min}-${month.min}-${day.min}`;
                const max_date = `${year.max}-${month.max}-${day.max}`;
                console.log(min_date)
                console.log(max_date)
                for (let jumlah = 0; jumlah < $(this).val(); jumlah++) {
                    angsuran_main.append(`<span>Angsuran ${jumlah + 1}</span>`);
                    var tgl_angsuran = document.createElement('input');
                    tgl_angsuran.type = 'date';
                    tgl_angsuran.id = 'tgl_angsuran';
                    tgl_angsuran.name = 'tgl_angsuran[]';
                    $(tgl_angsuran).attr({
                        'min': min_date
                    });
                    tgl_angsuran.max = max_date;
                    $(tgl_angsuran).prop('required', true);
                    tgl_angsuran.classList.add('tgl_angsuran')
                    tgl_angsuran.classList.add('form-control')
                    angsuran_main.append(tgl_angsuran);

                    var jumlah_angsuran = document.createElement('input');
                    jumlah_angsuran.type = 'number';
                    jumlah_angsuran.id = 'jumlah_angsuran';
                    $(jumlah_angsuran).prop('required', true);
                    jumlah_angsuran.placeholder = 'masukkan jumlah angsuran';
                    jumlah_angsuran.name = 'jumlah_angsuran[]';
                    jumlah_angsuran.value = (jumlah_pinjam / $(this).val()) + total_bunga;

                    jumlah_angsuran.classList.add('jumlah_angsuran')
                    jumlah_angsuran.classList.add('form-control')
                    angsuran_main.append(jumlah_angsuran);
                    angsuran_main.append("<br>");
                }

            })
            $("#tgl_kembali").change(function(e) {
                var tgl_pengajuan = new Date($("#tgl_pengajuan").val());
                var tgl_kembali = new Date($(this).val());
                var diff = diff_date(tgl_pengajuan, tgl_kembali)
                $('#lama_pinjam').val(diff)
            })

            function diff_date(date1, date2) {
                var d = Math.abs(date1 - date2) / 1000; // delta
                var r = {}; // result
                var s = { // structure
                    year: 31536000,
                    month: 2592000,
                    week: 604800, // uncomment row to ignore
                    day: 86400, // feel free to add your own row
                    hour: 3600,
                    minute: 60,
                    second: 1
                };

                Object.keys(s).forEach(function(key) {
                    r[key] = Math.floor(d / s[key]);
                    d -= r[key] * s[key];
                });
                console.log(r)
                return `${r.year} Tahun : ${r.month} Bulan : ${r.week} Minggu : ${r.day}  Hari `;
            }

        });
    </script>
@endsection

@section('js')
@endsection
