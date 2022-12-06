<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Simpanan extends Model
{
    use HasFactory;
    protected $table = 'simpanans';
    protected $fillable = ['kode_simpanan' , 'user_id', 'jumlah_simpanan', 'tgl_simpanan', 'total'];

}
