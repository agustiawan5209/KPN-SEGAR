<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Roles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    //DATA USER/PEMINJAM
    public function index()
    {
        $akun = User::all();
        return view('datauser.index', [
            'title' => "datauser",
            'akun' => $akun
        ]);
    }

    //DATA ADMIN
    public function dataadmin()
    {
        $akun = User::all();
        return view('dataadmin.index', [
            'title' => "dataadmin",
            'akun' => $akun
        ]);
    }

    //DATA KEPALA
    public function datakepala()
    {

        $akun = User::all();
        return view('datakepala.index', [
            'title' => "datakepala",
            'akun' => $akun
        ]);
    }


    // use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    // protected function validator(array $data)
    // {
    //     return Validator::make($data, [
    //         'name' => ['required', 'string', 'max:255'],
    //         'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
    //         'roles_id' => ['required', 'string', 'max:255'],
    //         'alamat' => ['required', 'string', 'max:255'],
    //         'telephone' => ['required', 'string', 'max:255'],
    //         'password' => ['required', 'string', 'min:8', 'confirmed'],
    //     ]);
    // }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'roles_id' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string', 'max:255'],
            'telephone' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $akun = new user;
        $akun->name = $request->input('name');
        $akun->username = $request->input('username');
        $akun->roles_id = $request->input('roles_id');
        $akun->alamat = $request->input('alamat');
        $akun->telephone = $request->input('telephone');
        $akun->password = Hash::make($request->password);
        $akun->status = '1';

        $akun->save();
        if ($akun->roles_id == 1) {
            return redirect()->route('data-admin')->with('success', 'Data Berhasil Ditambahkan!');
        } elseif ($akun->roles_id == 2) {
            return redirect()->route('data-Anggota')->with('success', 'Data Berhasil Ditambahkan!');
        } elseif ($akun->roles_id == 3) {
            return redirect()->route('data-user')->with('success', 'Data Berhasil Ditambahkan!');
        } elseif ($akun->roles_id == 4) {
            return redirect()->route('data-user')->with('success', 'Data Berhasil Ditambahkan!');
        }
    }

    public function edituser($id)
    {
        $akun = User::find($id);
        return view('datauser.edit', [
            'akun' => $akun,
            'title' => "Edit akun user"
        ]);
    }

    public function editadmin($id)
    {
        $akun = User::find($id);
        return view('dataadmin.edit', [
            'akun' => $akun,
            // 'user'=>$user,
            'title' => "Edit akun admin"
        ]);
    }

    public function editkepala($id)
    {
        $akun = User::find($id);
        return view('datakepala.edit', [
            'akun' => $akun,
            // 'user'=>$user,
            'title' => "Edit akun kepala"
        ]);
    }

    public function updateadmin(Request $request, $id)
    {
        User::find($id)->update($request->all());

        return redirect('/data-admin')->with('success', 'Data Admin Berhasil Di Update!');
    }

    public function updateuser(Request $request, $id)
    {
        User::find($id)->update($request->all());

        return redirect('/data-user')->with('success', 'Data Pengguna Berhasil Di Update!');
    }

    public function updatekepala(Request $request, $id)
    {
        User::find($id)->update($request->all());

        return redirect('/data-Anggota')->with('success', 'Data Berhasil Diupdate!');
    }


    //FUNCTION HAPUS DATA USER, ADMIN, Anggota
    public function hapususer($id)
    {
        $akun = User::find($id);
        $akun->delete();
        return redirect('/data-user')->with('success', 'Data Berhasil Dihapus!');
    }

    public function hapusadmin($id)
    {
        $akun = User::find($id);
        $akun->delete();
        return redirect('/data-admin')->with('success', 'Data Berhasil Dihapus!');
    }

    public function hapuskepala($id)
    {
        $akun = User::find($id);
        $akun->delete();
        return redirect('/data-Anggota')->with('success', 'Data Berhasil Dihapus!');
    }

    public function ubahstatus($id)
    {
        $akun = User::find($id);
        $status_sekarang = $akun->status;
        if ($status_sekarang == 1) {
            $akun->where('id', $id)->update([
                'status' => 0
            ]);
        } else {
            $akun->where('id', $id)->update([
                'status' => 1
            ]);
        }

        if ($akun->roles_id == 1) {
            return redirect()->route('data-admin')->with('success', 'Status Pengguna Berhasil diganti!');
        } elseif ($akun->roles_id == 3) {
            return redirect()->route('data-user')->with('success', 'Status Pengguna Berhasil diganti!');
        }
    }
}
