<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Angsuran extends Model
{
    use HasFactory;

    protected $table = 'angsurans';
    protected $fillable = ['pinjam_id', 'kode_angsuran','tgl_angsuran', 'jumlah_bayar','sisa_bayar','status', 'denda','jumlah_denda'];
}
