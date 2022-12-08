<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Angsuran extends Model
{
    use HasFactory;

    protected $table = 'angsurans';
    protected $fillable = ['pinjam_id', 'kode_angsuran','tgl_angsuran', 'jumlah_bayar','sisa_bayar','status', 'denda','jumlah_denda'];

    public function pinjam(){
        return $this->belongsTo(Pinjam::class, 'pinjam_id');
    }
    public function textStatus($value){
        switch ($value) {
            case '0':
               $Msg = '<span class="badge bg-secondary"><i class="bi bi-collection me-1"></i> Kosong</span>';
                break;

            case '1':
               $Msg = '<span class="badge bg-danger"><i class="bi bi-exclamation-octagon me-1"></i>Telat Di Bayar</span>';
                break;

            case '2':
               $Msg = '<span class="badge bg-success"><i class="bi bi-check-circle me-1"></i> Success</span>';
                break;

            default:
               $Msg = 'Error Status Kosong';
                break;
        }
        return $Msg;
    }
}
