<?php

namespace App\Http\Controllers;

use App\Models\PromoUser;
use App\Http\Requests\StorePromoUserRequest;
use App\Http\Requests\UpdatePromoUserRequest;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

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
        $promo = PromoUser::where('user_id',$user_id)->where('promo_id', '=', $promo_id)->get();
        if($promo->count() > 0){
            Alert::error('Maaf!!', "Promo Sudah Terpakai");
        }else{
            PromoUser::create([
                'promo_id' => $promo_id,
                'user_id' => $user_id,
                'status' => '1',
            ]);
        Alert::success('Selamat!!', 'Nikmati Potongan Anda');

        }
       return redirect()->back();


    }

    /**
     * update
     *
     * @param  mixed $promo_id
     * @param  mixed $id
     * @return void
     */
    public function update($promo_id, $id)
    {
        PromoUser::where('promo_id', '=', $promo_id)->where('id', $id)->update([
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
