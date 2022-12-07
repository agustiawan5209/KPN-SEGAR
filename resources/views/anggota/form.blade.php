@extends('customer.layout')
@section('content')
    <div class="container">
        <div class="row g-5">
            <div class=" col-lg-12">
                <h4 class="mb-3">Form Anggota</h4>
                <p>Isi Form Dibawah Ini untuk Daftar Jadi Anggota</p>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form class="needs-validation" action="{{ route('store-anggota') }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    @method('POST')
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <label for="firstName" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" name="nama_lengkap" placeholder="" value=""
                                required>
                            <div class="invalid-feedback">
                                Valid first name is required.
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <label for="lastName" class="form-label">Foto KTP</label>
                            <input type="file" class="form-control" name="foto_ktp" placeholder="" value=""
                                required>
                            <div class="invalid-feedback">
                                Valid last name is required.
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="firstName" class="form-label">Pekerjaan</label>
                            <input type="text" class="form-control" name="pekerjaan" placeholder="" value=""
                                required>
                            <div class="invalid-feedback">
                                Valid first name is required.
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <label for="lastName" class="form-label">Gaji</label>
                            <input type="number" class="form-control" name="gaji" placeholder="" value=""
                                required>
                            <div class="invalid-feedback">
                                Valid last name is required.
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <label for="lastName" class="form-label">Pendidikan Terakhir</label>
                            <select name="pendidikan" name="" class="form-select">
                                <option value="SD">SD</option>
                                <option value="SMP">SMP</option>
                                <option value="SMA/Sederajat">SMA/Sederajat</option>
                                <option value="D3/Sederajat">D3/Sederajat</option>
                                <option value="S1/Sederajat">S1/Sederajat</option>
                                <option value="S2">S2</option>
                                <option value="S3">S3</option>
                            </select>
                            <div class="invalid-feedback">
                                Valid last name is required.
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="firstName" class="form-label">Jenis Kelamin</label>
                            <select name="jenkel" name="" class="form-select">
                                <option value="--">--</option>
                                <option value="Perempuan">Perempuan</option>
                                <option value="Laki-Laki">Laki-Laki</option>
                            </select>
                            <div class="invalid-feedback">
                                Valid first name is required.
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <label for="lastName" class="form-label">Tempat Dan Tanggal Lahir</label>
                            <div class=" d-flex">
                                <input type="text" class="form-control cols-sm-4 w-25" name="tempat_lahir"
                                    placeholder="tempat lahir" value="" required>
                                <input type="date" class="form-control w-50" name="tgl_lahir" placeholder="" value=""
                                    required>
                            </div>
                            <div class="invalid-feedback">
                                Valid last name is required.
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="firstName" class="form-label">Status Menikah</label>
                            <select name="status" name="" class="form-select" required>
                                <option value="--">--</option>
                                <option value="Menikah">menikah</option>
                                <option value="Tidak Menikah">tidak menikah</option>
                            </select>
                            <div class="invalid-feedback">
                                Valid first name is required.
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <label for="lastName" class="form-label">Tanggungan</label>
                            <input type="number" class="form-control" name="tanggungan" placeholder="" value="">
                            <div class="invalid-feedback">
                                Valid last name is required.
                            </div>
                        </div>

                    </div>

                    <hr class="my-4">
                    <button class="w-100 primary-btn" type="submit">Lanjutkan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
