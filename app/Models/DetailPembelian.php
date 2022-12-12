<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPembelian extends Model
{
    use HasFactory;
    protected $table = 'detail_pembelians';
    protected $fillable = ['pembelian_id','nama_barang','harga','jumlah','total','potongan'];

    public function pembelian(){
        return $this->belongsTo(Pembelian::class, 'id');
    }
}
