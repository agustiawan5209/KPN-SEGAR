<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diskon extends Model
{
    use HasFactory;
    protected $table = 'diskons';
    protected $fillable = ['barang_id','diskon','tgl_mulai','tgl_akhir'];

    public function barang(){
        return $this->hasOne(Barang::class, 'id', 'barang_id');
    }
}
