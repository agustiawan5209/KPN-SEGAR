<button type="button" class="btn btn-sm" style="background-color:  #012970; color:#FFFFFF" data-bs-toggle="modal"
    data-bs-target="#modaldetail{{ $data->id }}">
    <i class="bi bi-eye"></i>
</button>
<div class="modal fade" id="modaldetail{{ $data->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                {{-- <h5 class="modal-title">Basic Modal</h5> --}}
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Card with an image on left -->


                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-md-4">


                        </div>
                        <div class="col-md-12">
                            <div class="card-body w-full">
                                <div class="row">
                                    <div class="col-lg-15">
                                        <h5 class="card-title text-center">
                                            Detail Data Peminjaman
                                        </h5>

                                        <p class="card-text">
                                        <div class="row">
                                            <div class="col-lg-5 col-md-4 label ">
                                                Kode peminjaman
                                            </div>
                                            <div class="col-lg-7 col-md-8">
                                                :{{ $data->kode_peminjaman }}
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-5 col-md-4 label">
                                                Peminjam </div>
                                            <div class="col-lg-7 col-md-8">
                                                :{{ $data->nama_peminjam }}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-5 col-md-4 label">
                                                jenis peminjaman
                                            </div>
                                            <div class="col-lg-7 col-md-8">
                                                :{{ $data->jenis_peminjaman }}
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-5 col-md-4 label">
                                                Tujuan </div>
                                            <div class="col-lg-7 col-md-8">
                                                :{{ $data->tujuan }}
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-5 col-md-4 label">
                                                Tanggal Pengajuan </div>
                                            <div class="col-lg-7 col-md-8">
                                                :{{ $data->tgl_pengajuan }}
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-5 col-md-4 label">
                                                Tanggal kembali :
                                            </div>
                                            <div class="col-lg-7 col-md-8">
                                                :{{ $data->tgl_kembali }}
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-5 col-md-4 label">
                                                Barang Pinjam </div>
                                            <div class="col-lg-7 col-md-8">
                                                :
                                                {{ $data->barangs->kode }}
                                                {{ $data->barangs->jenis_barangs->jenis_barang }}
                                                {{ $data->barangs->spesifikasi }}
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-5 col-md-4 label">
                                                Jumlah Pinjam </div>
                                            <div class="col-lg-7 col-md-8">
                                                :
                                                {{ $data->jumlah_pinjam }}
                                            </div>
                                        </div>

                                        </p>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- End Card with an image on left -->
            </div>
            <div class="modal-footer">


            </div>
        </div>
    </div>
</div><!-- End Basic Modal-->
