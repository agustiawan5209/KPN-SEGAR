<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LokasiPenempatan extends Model
{
    use HasFactory;
    protected $table = 'lokasi_penempatans';
    protected $fillable = [
        'lantai','ruangan'
    ];
}
