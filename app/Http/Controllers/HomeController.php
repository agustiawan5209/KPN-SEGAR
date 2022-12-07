<?php

namespace App\Http\Controllers;

use index;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\JenisBarang;
use App\Models\Barang;
use App\Models\DataJenisAset;
use App\Models\DataAsalPerolehan;
use App\Models\Peminjaman;
use App\Models\Satuan;
use App\Models\DetailPeminjaman;
use App\Models\Pinjam;
use App\Models\Tahun;
use App\Models\TrxStatus;
use Carbon\Carbon;


class HomeController extends Controller
{


    public function maindashboard()
    {
        $role = Auth::user()->roles_id;


        if ($role == '3') {



            return view('kepalaunit');
        }
        //role admin
        if ($role == '1') {


            return view('admin');
        }

        //role staff
        if ($role == '2') {
            return redirect()->route('Customer.Index');

        } else {
            return view('dashboard');
        }
    }


}
