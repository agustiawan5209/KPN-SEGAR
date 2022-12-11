<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;
    protected $table = 'anggotas';
    protected $fillable = ['kode_anggota', 'user_id', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function simpanan()
    {
        return $this->hasMany(Simpanan::class, 'kode_anggota', 'kode_anggota');
    }
    public function pinjam(){
        return $this->hasMany(Pinjam::class, 'kode_anggota', 'kode_anggota');
    }
    public function detail_anggota()
    {
        return $this->hasOne(DetailAnggota::class, 'anggota_id', 'id');
    }
}
