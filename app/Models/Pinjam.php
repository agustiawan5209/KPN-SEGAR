<?php

namespace App\Models;

use App\Policies\AnggotaPolicy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Pinjam extends Model
{
    use HasFactory;
    use Notifiable;
    protected $table = "pinjams";
    protected $fillable = [
        'kode_peminjaman',
        'users_id',
        'barangs_id',
        'jenis_id',
        'bunga',
        'status',
        'nama_peminjam',
        'jenis_peminjaman',
        'tujuan',
        'tgl_pengajuan',
        // 'tgl_pinjam',
        'tgl_kembali',
        // 'bukti_pinjam',
        'jumlah_pinjam',
        'ket',
        'status'

    ];

    public function trxstatus() //relasi tabel employee ke jenis posisi
    {

        return $this->hasMany(TrxStatus::class, 'kode_peminjaman', 'kode_peminjaman');
    }

    public function barangs()
    {
        return $this->hasOne(Barang::class,'id','barangs_id'); //1 karyawan mempunyai 1 posisi
    }

    public function status_konfirmasis()
    {
        return $this->belongsTo(StatusKonfirmasi::class, 'status_konfirmasis_id');
    }

    public function status_peminjamans()
    {
        return $this->belongsTo(StatusPeminjaman::class, 'status_peminjamans_id'); //1 karyawan mempunyai 1 posisi
    }

    public function anggota()
    {
        return $this->hasOne(Anggota::class, 'kode_anggota', 'kode_anggota'); //1 karyawan mempunyai 1 posisi
    }
    public function angsuran()
    {
        return $this->hasMany(Angsuran::class, 'pinjam_id', 'id'); //1 karyawan mempunyai 1 posisi
    }
}
