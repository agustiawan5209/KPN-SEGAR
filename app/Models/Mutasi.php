<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mutasi extends Model
{
    use HasFactory;
    protected $table = 'mutasis';
    protected $fillable = ['kode','barang_id','tgl_mutasi', 'dari', 'ke', 'ket','jumlah_mutasi'];
    protected $hidden = ['dari', 'ke'];

    public function barangs(){
        return $this->hasOne(Barang::class, 'id', 'barang_id');
    }
    public function lokasi(){
        return $this->hasOne(LokasiPenempatan::class, 'id', 'ke');
    }

}
