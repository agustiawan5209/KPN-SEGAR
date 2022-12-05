<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromoUser extends Model
{
    use HasFactory;
    protected $table = 'promo_users';
    protected $fillable = ['promo_id', 'user_id', 'status'];

    public function user(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    public function promo(){
        return $this->hasOne(Promo::class, 'id', 'promo_id');
    }
}
