<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    use HasFactory;
    protected $table = 'promos';
    protected $fillable = ['kode', 'jenis_promo', 'potongan', 'tgl_mulai', 'tgl_akhir'];

}
