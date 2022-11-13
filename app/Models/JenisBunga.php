<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisBunga extends Model
{
    use HasFactory;
    protected $table = 'jenis_bungas';
    protected $fillable = ['kode','jumlah_bulan', 'jumlah_bunga'];
}
