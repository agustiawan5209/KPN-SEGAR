<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailAnggota extends Model
{
    use HasFactory;

    protected $table = 'detail_anggotas';
    protected $fillable = ['anggota_id', 'nama_lengkap','foto_ktp','pekerjaan','gaji','pendidikan','tempat_lahir','tgl_lahir','jenkel','status','tanggungan'];

    public function anggota(){
        return $this->hasOne(Anggota::class, 'id','anggota_id');
    }
}
