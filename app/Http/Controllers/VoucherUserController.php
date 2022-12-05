<?php

namespace App\Http\Controllers;

use App\Models\VoucherUser;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreVoucherUserRequest;
use App\Http\Requests\UpdateVoucherUserRequest;

class VoucherUserController extends Controller
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
        VoucherUser::create([
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
        VoucherUser::where('voucher_id', '=', $voucher_id)->where('id', $id)->update([
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
        VoucherUser::where('id', $id)->delete();
    }
}
