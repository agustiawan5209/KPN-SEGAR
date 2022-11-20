<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class CustomerViewController extends Controller
{
    public function index(){
        $barang = Barang::all();
        return view('customer.index', [
            'barang'=> $barang,
        ]);
    }
    public function detail($id){
        $barang =Barang::find($id);
        return view('customer.product',[
            'barang'=> $barang,
        ]);
    }
}
