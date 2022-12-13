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
                                            Detail Data Pembelian
                                        </h5>

                                        <p class="card-text">
                                        <div class="row">
                                            <div class="col-lg-5 col-md-4 label ">
                                                Kode Pembelian
                                            </div>
                                            <div class="col-lg-7 col-md-8">
                                                :{{ $data->kode }}
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-5 col-md-4 label">
                                                Nama Pembeli </div>
                                            <div class="col-lg-7 col-md-8">
                                                :{{ $data->nama }}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-5 col-md-4 label">
                                                email Pembeli </div>
                                            <div class="col-lg-7 col-md-8">
                                                :{{ $data->email }}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-5 col-md-4 label">
                                                alamat Pembeli </div>
                                            <div class="col-lg-7 col-md-8">
                                                :{{ $data->alamat }}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-5 col-md-4 label">
                                                Nomor Pembeli </div>
                                            <div class="col-lg-7 col-md-8">
                                                :{{ $data->no_hp }}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-5 col-md-4 label">
                                                Tanggal Pembelian </div>
                                            <div class="col-lg-7 col-md-8">
                                                :{{ $data->tgl_transaksi }}
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-lg-5 col-md-4 label">
                                                Jumlah Pembelian </div>
                                            <div class="col-lg-7 col-md-8">
                                                :
                                                {{ Str::currency($data->sub_total) }}
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
