<?php

use App\Models\Barang;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * @param id $id
 * Kirim Request Pilih User
 * Dengan Param ID
 */
Route::get('/Get/User/{id}', function($id){
    $user = User::where('id', $id)->get();
    return response()->json($user);
});

/**
 * DATA ASET BERGERAK
 * @api
 */
Route::get('/Data/Aset-Bergerak', function(){
    $barang = Barang::where('jenis_asets_id', 1)->get();
    return response()->json($barang);
});
/**
 * DATA ASET TIDAK BERGERAK
 * @api
 */
Route::get('/Data/Aset-Tidak-Bergerak', function(){
    $barang = Barang::where('jenis_asets_id', 2)->get();
    return response()->json($barang);
});
/**
 * DATA ASET PERALATAN
 * @api
 */
Route::get('/Data/Aset-Peralatan', function(){
    $barang = Barang::where('jenis_asets_id', 3)->get();
    return response()->json($barang);
});
/**
 * DATA ASET PERLENGKAPAN
 * @api
 */
Route::get('/Data/Aset-Perlengkapan', function(){
    $barang = Barang::where('jenis_asets_id', 4)->get();
    return response()->json($barang);
});
