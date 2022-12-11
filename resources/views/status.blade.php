@php
    $trs = \App\Models\TrxStatus::where('pinjams_id', $data->id)
        ->where('kode_peminjaman', $data->kode_peminjaman)
        ->orderBy('id', 'desc')
        ->latest()
        ->first();
    // dd($trs);
    $b = \App\Models\Status::where('id', '=', $trs->status_id)->first();
@endphp
<div class="badge bg-light text-black btn-sm w-70 p-1 d-flex justify-content-between text-wrap dropdown-toggle{{ $data->kode_peminjaman }}"
    data-bs-toggle="modal" data-bs-target="#status{{ $data->kode_peminjaman }}" style="font-size: 1rem"
    id='#status{{ $data->kode_peminjaman }}'> <?= $b->ikon ?> {{ $b->status }} </div>


{{-- Modal Status --}}
<div class="modal fade" id="status{{ $data->kode_peminjaman }}" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLiveLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLiveLabel">
                    {{-- Status Pengajuan --}}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-12">


                        <div class="card">
                            <div class="card-body">

                                <h5 class="card-title">
                                    Status
                                    <span>|
                                        {{ Auth::user()->name }}</span>
                                </h5>
                                <div
                                    class="iq-timeline0 m-0 d-flex align-items-center justify-content-between position-relative">
                                    <ul class="list-inline p-0 m-0 relative box-border overflow-autoz">
                                        @foreach ($trxstatus as $a)
                                            @if ($data->id == $a->pinjams_id)
                                                <li>
                                                    <div
                                                        class="timeline-dots timeline-dot1 border-success text-primary">
                                                    </div>
                                                    @foreach ($status as $item)
                                                        @if ($a->status_id == $item->id)
                                                            <h6 style="color:#012970;" class="d-inline-block w-100">
                                                                <b>
                                                                    {{ $item->status }}
                                                                    <?= $item->ikon ?>
                                                                </b>
                                                            </h6>
                                                        @endif
                                                    @endforeach

                                                    <?php
                                                            foreach($akun as $p){
                                                                if($a->users_id == $p->id){?>
                                                    <div class="w-50 text-black">
                                                        <p>
                                                            Diverifikasi
                                                            oleh
                                                            :
                                                            {{ $p->name }}<br>
                                                            Pada
                                                            Tanggal
                                                            :
                                                            <?php echo date('d F Y', strtotime($a->created_at)); ?>
                                                            <br>
                                                            @if ($a->ket)
                                                                ket
                                                                :
                                                                {{ $a->ket }}
                                                            @endif
                                                            @if ($a->status_id == 3 || $a->status_id == 1)
                                                                ket
                                                                :
                                                                silakan
                                                                menemui
                                                                admin
                                                                untuk
                                                                mengambil
                                                                barang
                                                            @endif
                                                        </p>
                                                    </div>
                                                    <?php }
}
                                                                        ?>

                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
