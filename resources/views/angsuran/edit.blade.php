@extends('layouts.master')
@section('content')
    <main id="main" class="main overflow-hidden">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-center pb-0 fs-5">Formulir Edit Angsuran {{ $angsuran->kode_angsuran }}</h5></br>

                <!-- validation Form Elements -->

                <form id="form-formulir" action="{{ route('pinjamUang.UpdateAngsuran', ['id'=> $angsuran->id , 'pinjam_id'=> $angsuran->pinjam->id]) }}" method="POST" enctype="multipart/form-data"
                    class=" needs-validation" novalidate>
                    @csrf
                    @method('PUT')
                    <x-validation-errors />
                    <div class="row mb-3">
                        {{-- <label for="validationCustom01" class="col-sm-2 col-form-label">Nama login</label> --}}

                    </div>
                    <div class="row mb-3">
                        <label for="validationTooltip02" class="col-sm-2 col-form-label"> Jumlah bayar </label>
                        <div class="col-sm-10">
                            <input type="number" id="validationTooltip02" name="jumlah_bayar" id="jumlah_bayar" value="{{ $angsuran->jumlah_bayar }}"
                                class="form-control jumlah_bayar" required placeholder="0000000000">
                            <div class="invalid-feedback">
                                Harus di isi
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="validationTooltip05" class="col-sm-2 col-form-label">Sisa Bayar</label>
                        <div class="col-sm-10">
                            <input type="number" id="sisa_bayar" name="sisa_bayar" class="form-control" required value="{{ $angsuran->sisa_bayar }}">
                            <div class="invalid-feedback">
                                Harus di isi
                            </div>
                        </div>

                    </div>
                    <div class="row mb-3">
                        <label for="validationTooltip05" class="col-sm-2 col-form-label">Tgl Angsuran</label>
                        <div class="col-sm-10">
                            <input type="date" id="tgl_angsuran" name="tgl_angsuran" value="{{ $angsuran->tgl_angsuran }}"
                                 class="form-control" required>
                            <div class="invalid-feedback">
                                Harus di isi
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="validationTooltip02" class="col-sm-2 col-form-label"> Status Denda </label>
                        <div class="col-sm-10">
                            <select  id="denda" name="denda" class="form-select" required>
                                <option value="">---</option>
                                <option value="1">Belum Dibayar</option>
                                <option value="2">Dibayar</option>
                            </select>
                            <div class="invalid-feedback">
                                Harus di isi
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="validationTooltip05" class="col-sm-2 col-form-label">Denda Bayar</label>
                        <div class="col-sm-10">
                            <input type="number" id="jumlah_denda" name="jumlah_denda" class="form-control" required value="{{ $angsuran->jumlah_denda }}">
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
@endsection

@section('js')
@endsection
