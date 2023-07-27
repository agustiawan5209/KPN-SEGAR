<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Roles;
use App\Models\Voucher;
use App\Models\VoucherUser;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users,username'],
            'email' => ['required', 'string', 'max:255', 'unique:users,email'],
            // 'roles_id' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string', 'max:255'],
            'telephone' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user =  User::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'roles_id' => '2',
            'alamat' => $data['alamat'],
            'email' => $data['email'],
            'telephone' => $data['telephone'],
            'status'=> '1',
            'password' => Hash::make($data['password']),
        ]);
        $voucher = Voucher::where('jenis_voucher', '=', '1')->orderBy('id', 'desc')->first();
        if($voucher != null){
            VoucherUser::create([
                'voucher_id' => $voucher->id,
                'user_id' => $user->id,
                'jenis_voucher' => '1',
            ]);
        }
        return $user;
    }
}
