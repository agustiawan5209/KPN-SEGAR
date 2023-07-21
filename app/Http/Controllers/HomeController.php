<?php

namespace App\Http\Controllers;

use index;
use Carbon\Carbon;

use App\Models\User;
use App\Models\Tahun;
use App\Models\Barang;
use App\Models\Pinjam;
use App\Models\Satuan;
use App\Models\Anggota;
use App\Models\Pembelian;
use App\Models\TrxStatus;
use App\Models\Peminjaman;
use App\Models\JenisBarang;
use Illuminate\Http\Request;
use App\Models\DataJenisAset;
use App\Models\DetailPeminjaman;
use App\Models\DataAsalPerolehan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{


    public function maindashboard()
    {

        $jumlah_anggota = Anggota::all()->count();
        $jumlah_pengguna = User::where('roles_id', 2)->get()->count();
        $pembelian = Pembelian::sum('sub_total');
        $data = compact('jumlah_anggota', 'jumlah_pengguna', 'pembelian');
        $role = Auth::user()->roles_id;


        if ($role == '3') {



            return view('kepalaunit');
        }
        //role admin
        if ($role == '1') {


            return view('admin', $data);
        }

        //role staff
        if ($role == '2') {
            return redirect()->route('Customer.Index');

        } else {
            return view('dashboard');
        }
    }


}
