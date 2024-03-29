@extends('layouts.master')
@section('content')

@section('title', 'asetbergerak')
@section('asetbergerak', 'active')
@section('forms-nav', 'show')



{{-- <script>
    var loadFile = function(event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
        }
    };
</script> --}}


<main id="main" class="main">

    <div class="pagetitle">
        {{-- <h1>Data Jenis Aset</h1> --}}
        {{-- <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Tables</li>
          <li class="breadcrumb-item active">Data</li>
        </ol>
      </nav> --}}
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">


                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Formulir Input Data</h5>

                        <!-- validation Form Elements -->
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                        <form action="{{ route('create') }}" method="POST"
                            enctype="multipart/form-data"class=" needs-validation" novalidate>
                            @csrf
                            <div class="row mb-3">
                                <label for="validationCustom01" class="col-sm-2 col-form-label">Kode</label>
                                <div class="col-sm-10">
                                    <input type="text" id="validationCustom01" value="{{ $Kode }}" readonly
                                        name="kode" class="form-control" required>
                                    <div class="invalid-feedback">
                                        Harus di isi
                                    </div>
                                </div>
                            </div>


                            <div class="row mb-3">
                                <label for="validationTooltip06" class="col-sm-2 col-form-label">Katalog Barang</label>
                                <div class="col-sm-10">
                                    <select class="form-select" name="jenis_barangs_id" id="validationTooltip06"
                                        aria-label="Default select example">
                                        <option value=''>Pilih Katalog Barang</option>
                                        @foreach ($jenisbarang as $data)
                                            <option value="{{ $data->id }}"> {{ $data->jenis_barang }}</option>
                                        @endforeach
                                    </select>
                                    @error('jenis_barangs_id')
                                        <div class="text-danger">
                                            Harus di isi
                                        </div>
                                    @enderror
                                </div>
                            </div>


                            <div class="row mb-3">
                                <label for="validationTooltip02"
                                    class="col-sm-2 col-form-label">Nama Barang</label>
                                <div class="col-sm-10">
                                    <input type="text" id="validationTooltip02" name="nama_barang"
                                        class="form-control" required>
                                    <div class="invalid-feedback">
                                        Harus di isi
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="validationTooltip03" class="col-sm-2 col-form-label">File Gambar</label>
                                <div class="col-sm-10">
                                    <input class="form-control"required type=file name="foto"
                                        oninput="pic.src=window.URL.createObjectURL(this.files[0])">
                                    <img id="pic" style="width: 250px;">
                                    <div class="invalid-feedback">
                                        Harus di isi
                                    </div>
                                </div>
                            </div>


                            <div class="row mb-3">
                                {{-- <label for="validationTooltip02" class="col-sm-2 col-form-label">Jenis Aset</label> --}}
                                <div class="col-sm-10">
                                    <input type="hidden" value="1" name="jenis_asets_id" id="validationTooltip02"
                                        class="form-control" required>
                                    <div class="invalid-feedback">
                                        Harus di isi
                                    </div>
                                </div>
                            </div>



                            <div class="row mb-3">
                                <label for="validationTooltip05" class="col-sm-2 col-form-label">Tanggal
                                    Perolehan</label>
                                <div class="col-sm-10">
                                    <input type="date" id="validationTooltip05" name="tanggal_perolehan"
                                        class="form-control" required>
                                    <div class="invalid-feedback">
                                        Harus di isi
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="validationTooltip06" class="col-sm-2 col-form-label">Asal Perolehan</label>
                                <div class="col-sm-10">
                                    <select class="form-select" name="asal_perolehans_id" id="validationTooltip06"
                                        aria-label="Default select example">
                                        <option value=''>Silakan Pilih Asal Perolehan</option>
                                        @foreach ($dataasalperolehan as $data)
                                            <option value="{{ $data->id }}"> {{ $data->nama_asalperolehan }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('asal_perolehans_id')
                                        <div class="text-danger">
                                            Harus di isi
                                        </div>
                                    @enderror
                                </div>
                            </div>


                            <div class="row mb-3">





                                <div class="row mb-3">
                                    <label for="validationTooltip04" class="col-sm-2 col-form-label">Harga Barang</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="validationTooltip04" name="harga"
                                            class="form-control" required>
                                        <div class="invalid-feedback">
                                            Harus di isi
                                        </div>
                                    </div>
                                </div>



                                <div class="row mb-3">
                                    <label for="validationTooltip04" class="col-sm-2 col-form-label">Jumlah
                                        Barang</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="validationTooltip04" name="jumlah"
                                            class="form-control" required value="{{ old('jumlah') }}">
                                        <div class="invalid-feedback">
                                            Harus di isi
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="validationTooltip06" class="col-sm-2 col-form-label">Satuan</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" id="validationTooltip06" name="satuans_id"
                                            aria-label="Default select example">
                                            <option value=''>Silakan Pilih Satuan</option>
                                            @foreach ($datasatuan as $data)
                                                <option value="{{ $data->id }}"> {{ $data->nama_satuan }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">
                                            Harus di isi
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="validationTooltip06" class="col-sm-2 col-form-label">Kondisi</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" id="validationTooltip06" name="kondisi"
                                            aria-label="Default select example">
                                            <option value=''>Kondisi Barang</option>
                                            <option value="Baik">Baik</option>
                                            <option value="Cukup">Cukup</option>
                                            <option value="Tidak Baik">Tidak Baik</option>
                                        </select>
                                        @error('kondisi')
                                            <div class="text-danger">
                                                Harus di isi
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="validationTooltip04"
                                        class="col-sm-2 col-form-label">Keterangan</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="validationTooltip04" name="ket"
                                            class="form-control"required>
                                        <div class="invalid-feedback">
                                            Harus di isi
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-10">
                                        <button style=" float :right; background-color:   #012970; color:#FFFFFF"
                                            type="submit" class="btn btn">Submit</button>
                                    </div>
                                </div>
                        </form><!-- End General Form Elements -->



                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
