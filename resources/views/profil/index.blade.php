@extends('layouts.master')
@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Profil akun <?= Auth::user()->name ?> </h1>

        </div><!-- End Page Title -->

        <div class="col-xl-8">

            <div class="card">
                <div class="card-body pt-3">

                    </ul>
                    <div class="tab-content pt-2">

                        <div class="tab-pane fade show active profile-overview" id="profile-overview">

                            <h5 class="card-title">Profile Akun</h5>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label ">Nama</div>
                                <div class="col-lg-9 col-md-8"><?= Auth::user()->name ?></div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Username</div>
                                <div class="col-lg-9 col-md-8"><?= Auth::user()->username ?></div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Alamat</div>
                                <div class="col-lg-9 col-md-8"><?= Auth::user()->alamat ?></div>
                            </div>


                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Telephone</div>
                                <div class="col-lg-9 col-md-8"><?= Auth::user()->telephone ?></div>
                            </div>


                        </div>



                    </div><!-- End Bordered Tabs -->

                </div>
            </div>

        </div>
        </div>
        </section>

    </main><!-- End #main -->
@endsection
