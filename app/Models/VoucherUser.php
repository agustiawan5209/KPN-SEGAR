<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoucherUser extends Model
{
    use HasFactory;
    protected $table = 'voucher_users';
    protected $fillable = ['voucher_id', 'user_id', 'status'];

    public function user(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    public function voucher(){
        return $this->hasOne(Voucher::class, 'id', 'voucher_id');
    }
}
