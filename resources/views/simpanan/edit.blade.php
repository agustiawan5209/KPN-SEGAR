@extends('layouts.master')
@section('content')
    <main id="main" class="main overflow-hidden">
        <div class="card">
            <div class="card-body">

                <h5 class="card-title text-center pb-0 fs-5">Formulir Simpanan Anggota</h5></br>

                <!-- validation Form Elements -->

                <form id="form-formulir" action="{{ route('simpanan.update', ['id'=> $simpanan->id]) }}" method="POST" enctype="multipart/form-data"
                    class=" needs-validation" novalidate>
                    @csrf
                    @method('PUT')
                    <x-validation-errors />
                    <div class="row mb-3">
                        {{-- <label for="validationCustom01" class="col-sm-2 col-form-label">Nama login</label> --}}
                        <div class="col-sm-10">


                            <input type="hidden" id="validationCustom01" name="kode_anggota" value="{{ $simpanan->kode_anggota }}"
                                class="form-control" required readonly>


                            <div class="invalid-feedback">
                                Harus di isi
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="validationTooltip02" class="col-sm-2 col-form-label"> Jumlah Debit  </label>
                        <div class="col-sm-10">
                            <input type="number" id="validationTooltip02" name="debit" id="debit" value="{{ $simpanan->debit }}"
                                class="form-control debit" required placeholder="0000000000">
                            <div class="invalid-feedback">
                                Harus di isi
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="validationTooltip02" class="col-sm-2 col-form-label"> Jumlah Kredit  </label>
                        <div class="col-sm-10">
                            <input type="number" id="validationTooltip02" name="kredit" id="kredit" value="{{ $simpanan->kredit }}"
                                class="form-control kredit" required placeholder="0000000000">
                            <div class="invalid-feedback">
                                Harus di isi
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="validationTooltip05" class="col-sm-2 col-form-label">Tgl Simpanan</label>
                        <div class="col-sm-10">
                            <input type="date" id="tgl_simpanan" name="tgl_simpanan" value="{{ $simpanan->tgl_simpanan }}"
                                class="form-control" required>
                            <div class="invalid-feedback">
                                Harus di isi
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ url()->previous() }}" class="btn btn-danger">Kembali</a>

                </form><!-- End General Form Elements -->
            </div>


        </div>
    </main>
@endsection

@section('js')
@endsection
