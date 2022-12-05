<?php

namespace App\Http\Controllers;

use App\Models\PromoUser;
use App\Http\Requests\StorePromoUserRequest;
use App\Http\Requests\UpdatePromoUserRequest;
use Illuminate\Support\Facades\Auth;

class PromoUserController extends Controller
{
    /**
     * store
     *
     * @param  mixed $promo_id
     * @return void
     */
    public function store($promo_id)
    {
        $user_id = Auth::user()->id;
        PromoUser::create([
            'promo_id' => $promo_id,
            'user_id' => $user_id,
            'status' => '1',
        ]);
    }

    /**
     * update
     *
     * @param  mixed $voucher_id
     * @param  mixed $id
     * @return void
     */
    public function update($voucher_id, $id)
    {
        PromoUser::where('voucher_id', '=', $voucher_id)->where('id', $id)->update([
            'status' => '2',
        ]);
    }


    /**
     * destroy
     *
     * @param  mixed $id
     * @return void
     */
    public function destroy($id)
    {
        PromoUser::where('id', $id)->delete();
    }
}
