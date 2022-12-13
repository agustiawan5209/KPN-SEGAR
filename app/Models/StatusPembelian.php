<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusPembelian extends Model
{
    use HasFactory;
    protected $table = 'status_pembelians';
    protected $fillable = ['pembelian_id','status','ket'];

    public function pembelian(){
        return $this->hasOne(Pembelian::class, 'id','pembelian_id');
    }

}
