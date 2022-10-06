<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrxStatus extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = "trx_status";
    protected $fillable = [
        'kode_peminjaman',
        'status_id',
        'pinjams_id',
        'ket',
    ];

    public function status() // relasi tabel posisi ke kryawan
    {
        return $this->belongsTo(Pinjam::class, 'status_id'); //1 trx mempunyai banyak status
    }

    public function pinjams() // relasi tabel posisi ke kryawan
    {
        return $this->belongsTo(Pinjam::class, 'pinjams_id'); //1 trx mempunyai banyak Pinjam
    }
}
