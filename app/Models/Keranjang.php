<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    use HasFactory;

    protected $table = 'keranjangs';
    protected $fillable = ['user_id'.'barang_id','foto','nama_barang','jumlah','harga','total'];

    public function barang(){
        return $this->belongsTo(Barang::class,'barang_id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

}
