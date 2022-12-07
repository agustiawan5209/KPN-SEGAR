<?php

use App\Models\Pinjam;
use App\Models\Voucher;
use App\Http\Controllers\PinjamUang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\DiskonController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\MutasiController;
use App\Http\Controllers\PinjamController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\DataSatuanController;
use App\Http\Controllers\JenisBungaController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\JenisBarangController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\CustomerViewController;
use App\Http\Controllers\DataJenisAsetController;
use App\Http\Controllers\DataAsalPerolehanController;
use App\Http\Controllers\VoucherController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::POST('insertstatus', [PinjamController::class, 'insertstatus'])->name('insertstatus');
Route::GET('/mengembalikan/{id}', [PinjamController::class, 'mengembalikan']);
Route::GET('/menyetujui/{id}', [PinjamController::class, 'menyetujui']);

//LANDING PAGES
Route::get('/', function () {
    return view('landingpages');
});

//LOGIN REGISTER
Route::get('/login', function () {
    return view('auth.login');
});

// Route::get('/register', function () {
//     return view('auth.register');
// });

//NAVBAR DI BAGIAN PROFIL SEMUA ROLE BISA AKSES PROFIL MASING2 JIKA SUDAH LOGIN
Route::get('/profil', function () {
    return view('profil.index');
});

//ROUTE SETELAH LOGIN MASUK KE MASING2 DASHBOARD ROLENYA
Route::middleware(['auth', 'check.role:1,2,3,4'])
    ->get('/dashboard', [HomeController::class, 'maindashboard'])
    ->name('dashboard');
Route::get('/filterthn/{tahun}', [HomeController::class, 'rekap_tahun']); //menampilkan filter tahun

Auth::routes();

// View Customer
Route::group(['check.role:2', 'prefix' => 'Produk', 'as' => 'Customer.'], function () {
    Route::get('/', [CustomerViewController::class, 'index'])->name('Index');
    Route::get('/all', [CustomerViewController::class, 'produk'])->name('allproduk');
    Route::get('Produk/detail/{id}', [CustomerViewController::class, 'detail'])->name('detail');
    Route::get('/Promo-Diskon', [CustomerViewController::class, 'potongan'])->name('potongan');
});
Route::get('Dashboard', [CustomerViewController::class, 'DashboardUser'])->name('dashboardUser');
// Data Bunga
Route::group(['auth', 'check.role:2'], function () {
    Route::resource('JenisBunga', JenisBungaController::class)->parameters([
        'edit' => 'id',
        'store' => 'id',
        'show' => 'id',
        'destroy' => 'id',
    ])->name('*', 'jenis-bunga');
    Route::resource('Pembelian', PembelianController::class)->parameters([
        'edit' => 'id',
        'store' => 'id',
        'destroy' => 'id',
    ])->name('*', 'Pembelian.');
    Route::get('Pembelian-Riwayat', [PembelianController::class, 'riwayat'])->name('Pembelian.riwayat');
    Route::get('Pembelian-cekdata', [PembelianController::class, 'cekdata'])->name('Pembelian.cekdata');
    Route::get('Pembelian-detail/{id}', [PembelianController::class, 'detail'])->name('Pembelian.detail');
    Route::get('RiwayatPembelian', [PembelianController::class, 'dataPembelian'])->name('Pembelian.data');
});

Route::middleware(['auth', 'check.role:1'])->group(function(){
    Route::group(['prefix'=>'Diskon', 'as'=> 'Diskon.'],function(){
        Route::controller(DiskonController::class)->group(function(){
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::put('/update/{id}', 'update')->name('update');
            Route::get('/destroy/{id}', 'destroy')->name('destroy');
        });
    });
    Route::group(['prefix'=>'Promo', 'as'=> 'Promo.'],function(){
        Route::controller(PromoController::class)->group(function(){
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::put('/update/{id}', 'update')->name('update');
            Route::get('/destroy/{id}', 'destroy')->name('destroy');
        });
    });
    Route::group(['prefix'=>'Voucher', 'as'=> 'Voucher.'],function(){
        Route::controller(VoucherController::class)->group(function(){
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::put('/update/{id}', 'update')->name('update');
            Route::get('/destroy/{id}', 'destroy')->name('destroy');
        });
    });
});
//--SEMUA ROUTE ROLE ADMIN ( ROLE 1)--//
Route::middleware(['auth', 'check.role:1,3'])->group(function () {
    // Ubah Status
    Route::get('/ubah/status/{id}', [UserController::class, 'ubahstatus']);
    //SIDEBAR ADMIN /ROLE 1
    Route::get('/datajenisaset', function () {
        return view('datajenisaset.index');
    });

    Route::get('/dataasalperolehan', function () {
        return view('dataasalperolehan.index');
    });

    Route::get('/data-aset', function () {
        return view('dataaset.index');
    });

    Route::get('/data-aset/form', function () {
        return view('dataaset.form');
    });

    Route::get('/jenisbarang', function () {
        return view('jenisbarang.index');
    });

    Route::get('/datasatuan', function () {
        return view('datasatuan.index');
    });

    Route::get('/data-asetbergerak', function () {
        return view('dataasetbergerak.index');
    });

    Route::get('/barang/form', function () {
        return view('dataasetbergerak.form');
    });

    Route::get('/data-peralatan', function () {
        return view('dataperalatan.index');
    });

    Route::get('/data-peralatan/form', function () {
        return view('dataperalatan.form');
    });

    Route::get('/data-perlengkapan', function () {
        return view('dataperlengkapan.index');
    });

    Route::get('/data-perlengkapan/form', function () {
        return view('dataperlengkapan.form');
    });

    Route::get('/barang-keluar', function () {
        return view('barangkeluar.index');
    });

    Route::get('/barang-keluar/form', function () {
        return view('barangkeluar.form');
    });

    // Route::get('/barang-masuk', function () {
    //     return view('barangmasuk.index');
    // });

    // Route::get('/barang-masuk/form', function () {
    //     return view('barangmasuk.form');
    // });

    Route::get('/data-user', function () {
        return view('datauser.index');
    });

    Route::get('/data-user/form', function () {
        return view('datauser.form');
    });

    Route::get('/data-admin/form', function () {
        return view('dataadmin.form');
    });

    Route::get('/data-admin', function () {
        return view('dataadmin.index');
    });

    Route::get('/data-kepala/form', function () {
        return view('datakepala.form');
    });

    Route::get('/data-kepala', function () {
        return view('datakepala.index');
    });

    // Data Bunga

    //DATA AKUN USER
    Route::get('/data-user', [UserController::class, 'index']); //menampilkan data user
    Route::POST('/data-user', 'App\Http\Controllers\UserController@create')->name('data-user');
    Route::get('/data-user/edit/{id}', 'App\Http\Controllers\UserController@edituser')->name('@edituser');
    Route::post('/data-user/update/{id}', 'App\Http\Controllers\UserController@updateuser')->name('updateuser');
    Route::get('/data-user/hapus/{id}', 'App\Http\Controllers\UserController@hapususer')->name('hapususer');

    //DATA AKUN ADMIN
    Route::POST('/data-admin', 'App\Http\Controllers\UserController@create')->name('data-admin');
    Route::get('/data-admin', [UserController::class, 'dataadmin'])->name('data-admin');
    Route::get('/data-admin/edit/{id}', 'App\Http\Controllers\UserController@editadmin')->name('editadmin');
    Route::post('/data-admin/update/{id}', 'App\Http\Controllers\UserController@updateadmin')->name('updateadmin');
    Route::get('/data-admin/hapus/{id}', 'App\Http\Controllers\UserController@hapusadmin')->name('hapusadmin');

    //DATA AKUN BENDAHARA
    Route::POST('/data-kepala', 'App\Http\Controllers\UserController@create')->name('data-kepala');
    Route::get('/data-kepala', [UserController::class, 'datakepala'])->name('data-kepala');
    Route::get('/data-kepala/edit/{id}', 'App\Http\Controllers\UserController@editkepala')->name('editkepala');
    Route::post('/data-kepala/update/{id}', 'App\Http\Controllers\UserController@updatekepala')->name('updatekepala');
    Route::get('/data-kepala/hapus/{id}', 'App\Http\Controllers\UserController@hapuskepala')->name('hapuskepala');

    //DATA JENIS ASET
    Route::POST('inputjenisaset', 'App\Http\Controllers\DataJenisAsetController@inputjenisaset')->name('inputjenisaset');
    Route::get('/datajenisaset', [DataJenisAsetController::class, 'index']);
    Route::get('/datajenisaset/edit/{id}', 'App\Http\Controllers\DataJenisAsetController@editjenisaset')->name('editjenisaset');
    Route::post('/datajenisaset/update/{id}', 'App\Http\Controllers\DataJenisAsetController@updatejenisaset')->name('updatejenisaset');
    Route::get('/datajenisaset/hapusjenisaset/{id}', 'App\Http\Controllers\DataJenisAsetController@hapusjenisaset')->name('hapusjenisaset');

    //DATA ASAL PEROLEHAN
    Route::POST('inputasalperolehan', 'App\Http\Controllers\DataAsalPerolehanController@inputasalperolehan')->name('inputasalperolehan');
    Route::get('/dataasalperolehan', [DataAsalPerolehanController::class, 'index']);
    Route::get('/dataasalperolehan/edit/{id}', 'App\Http\Controllers\DataAsalPerolehanController@editasalperolehan')->name('editasalperolehan');
    Route::post('/dataasalperolehan/update/{id}', 'App\Http\Controllers\DataAsalPerolehanController@updateasalperolehan')->name('updateasalperolehan');
    Route::get('/dataasalperolehan/hapusasalperolehan/{id}', 'App\Http\Controllers\DataAsalPerolehanController@hapusasalperolehan')->name('hapusasalperolehan');

    //DATA SATUAN
    Route::POST('inputsatuan', 'App\Http\Controllers\DataSatuanController@inputsatuan')->name('inputsatuan');
    Route::get('/datasatuan', [DataSatuanController::class, 'index']);
    Route::get('/datasatuan/edit/{id}', 'App\Http\Controllers\DataSatuanController@editsatuan')->name('editsatuan');
    Route::post('/datasatuan/update/{id}', 'App\Http\Controllers\DataSatuanController@updatesatuan')->name('updatesatuan');
    Route::get('/datasatuan/hapussatuan/{id}', 'App\Http\Controllers\DataSatuanController@hapussatuan')->name('hapussatuan');

    //DATA Jenis Barang
    Route::POST('inputjenisbarang', 'App\Http\Controllers\JenisBarangController@inputjenisbarang')->name('inputjenisbarang');
    Route::get('/jenisbarang', [JenisBarangController::class, 'index']);
    Route::get('/jenisbarang/edit/{id}', 'App\Http\Controllers\JenisBarangController@editjenisbarang')->name('editjenisbarang');
    Route::post('/jenisbarang/update/{id}', 'App\Http\Controllers\JenisBarangController@updatejenisbarang')->name('updatejenisbarang');
    Route::get('/jenisbarang/hapusjenisbarang/{id}', 'App\Http\Controllers\JenisBarangController@hapusjenisbarang')->name('hapusjenisbarang');

    //DATA ASET
    Route::POST('create', 'App\Http\Controllers\BarangController@create')->name('create');
    Route::get('/data-aset/form', [BarangController::class, 'formasettidakbergerak']);
    Route::get('/data-aset', [BarangController::class, 'dataaset']);
    Route::get('/data-aset/edit/{id}', 'App\Http\Controllers\BarangController@editdataaset')->name('editdataaset');
    Route::post('/data-aset/update/{id}', 'App\Http\Controllers\BarangController@update')->name('update');
    Route::get('/data-aset/hapusdataaset/{id}', 'App\Http\Controllers\BarangController@hapusdataaset')->name('hapusdataaset');

    //DATA ASET BERGERAK
    // Route::POST('create', 'App\Http\Controllers\BarangController@create')->name('create');
    Route::get('/barang/form', [BarangController::class, 'formasetbergerak']);
    Route::get('/Barang', [BarangController::class, 'dataasetbergerak'])->name('barang');
    Route::get('/barang/edit/{id}', 'App\Http\Controllers\BarangController@editasetbergerak')->name('editasetbergerak');
    Route::post('/data-asetbergerak/update/{id}', 'App\Http\Controllers\BarangController@update')->name('data-asetbergerak.update');
    Route::get('/data-asetbergerak/hapus/{id}', 'App\Http\Controllers\BarangController@hapusasetbergerak')->name('hapusasetbergerak');

    //DATA ASET PERALATAN
    // Route::POST('create', 'App\Http\Controllers\BarangController@create')->name('create');
    Route::get('/data-peralatan/form', [BarangController::class, 'formperalatan']);
    Route::get('/data-peralatan', [BarangController::class, 'dataasetperalatan']);
    Route::get('/data-peralatan/edit/{id}', 'App\Http\Controllers\BarangController@editperalatan')->name('editperalatan');
    Route::post('/data-peralatan/update/{id}', 'App\Http\Controllers\BarangController@update')->name('update');
    Route::get('/data-peralatan/hapus/{id}', 'App\Http\Controllers\BarangController@hapusperalatan')->name('hapusperalatan');

    //DATA ASET PERLENGKAPAN
    // Route::POST('create', 'App\Http\Controllers\BarangController@create')->name('create');
    Route::get('/data-perlengkapan/form', [BarangController::class, 'formperlengkapan']);
    Route::get('/data-perlengkapan', [BarangController::class, 'dataasetperlengkapan']);
    Route::get('/data-perlengkapan/edit/{id}', 'App\Http\Controllers\BarangController@editperlengkapan')->name('editperlengkapan');
    Route::post('/data-perlengkapan/update/{id}', 'App\Http\Controllers\BarangController@update')->name('update');
    Route::get('/data-perlengkapan/hapus/{id}', 'App\Http\Controllers\BarangController@hapusperlengkapan')->name('hapusperlengkapan');

    //PENCATATAN STOK MASUK
    Route::POST('inputstokmasuk', 'App\Http\Controllers\BarangMasukController@inputstokmasuk')->name('inputstokmasuk');
    Route::get('/barang-masuk/form', [BarangMasukController::class, 'index']);
    Route::get('/barang-masuk', [BarangMasukController::class, 'barangmasuk']);
    Route::get('/barang-masuk/edit/{id}', 'App\Http\Controllers\BarangMasukController@editbarangmasuk')->name('editbarangmasuk');
    Route::post('/barang-masuk/update/{id}', 'App\Http\Controllers\BarangMasukController@updatebarangmasuk')->name('updatebarangmasuk');
    Route::get('/barang-masuk/hapus/{id}', 'App\Http\Controllers\BarangMasukController@hapusbarangmasuk')->name('hapusbarangmasuk');
    Route::get('/barang-masuk/status_masuk/{id}', 'App\Http\Controllers\BarangMasukController@stok_masuk');

    //PENCATATAN STOK/BARANG KELUAR
    Route::POST('inputbarangkeluar', 'App\Http\Controllers\BarangKeluarController@inputbarangkeluar')->name('inputbarangkeluar');
    Route::get('/barang-keluar/form', [BarangKeluarController::class, 'index']);
    Route::get('/barang-keluar', [BarangKeluarController::class, 'barangkeluar']);
    Route::get('/barang-keluar/edit/{id}', 'App\Http\Controllers\BarangKeluarController@editbarangkeluar')->name('editbarangkeluar');
    Route::post('/barang-keluar/update/{id}', 'App\Http\Controllers\BarangKeluarController@updatebarangkeluar')->name('updatebarangkeluar');
    Route::get('/barang-keluar/hapus/{id}', 'App\Http\Controllers\BarangKeluarController@hapusbarangkeluar')->name('hapusbarangkeluar');
    Route::get('/barang-keluar/status_keluar/{id}', 'App\Http\Controllers\BarangKeluarController@stok_keluar');

    //PEMINJAMAN ADMIN
    Route::get('/peminjaman/edit/{id}', 'App\Http\Controllers\PeminjamanController@editpeminjaman')->name('editpeminjaman');
    Route::post('/peminjaman/update/{id}', 'App\Http\Controllers\PeminjamanController@updatepeminjaman')->name('updatepeminjaman');
    Route::get('/peminjaman/hapus/{id}', 'App\Http\Controllers\PeminjamanController@hapuspeminjaman')->name('hapuspeminjaman');

    //PEMINJAMAN//STATUS YG GANTI ADMIN
    Route::get('/status_pengajuan/{kode_peminjaman}', 'App\Http\Controllers\PeminjamanController@status_pengajuan');
    Route::get('/status_batal/{kode_peminjaman}', 'App\Http\Controllers\PeminjamanController@status_batal');
    Route::get('/status_barangdiambil/{kode_peminjaman}', 'App\Http\Controllers\PeminjamanController@status_barangdiambil');
    Route::get('/status_kembali/{kode_peminjaman}', 'App\Http\Controllers\PeminjamanController@status_kembali');

    //RIWAYAT PEMINJAM ADMIN
    Route::get('/peminjaman/peminjaman', [PinjamController::class, 'peminjaman']);
    Route::get('/peminjaman/riwayatpinjam', [PinjamController::class, 'riwayatadmin']); //
    Route::get('/detailbarangadmin/{id}', [PeminjamanController::class, 'detail_barang_admin']);
    Route::get('/detailriwayatadmin/{id}', [PeminjamanController::class, 'detail_riwayat_admin']);
    Route::get('/peminjaman/pengembalian', [PeminjamanController::class, 'pengembalianadmin']);

    // LOKASI
    Route::get('/lokasi/penempatan', [LokasiController::class, 'index'])->name('lokasi');
    Route::get('/lokasi/{id}', [LokasiController::class, 'edit'])->name('lokasi-edit');
    Route::post('/lokasi/penempatan', [LokasiController::class, 'create'])->name('lokasi-create');
    Route::put('/lokasi/penempatan/{id}', [LokasiController::class, 'update'])->name('lokasi-update');
    Route::get('/lokasi/penempatan/{id}', [LokasiController::class, 'destroy'])->name('lokasi-delete');

    // Route MUTASI BARANG
    Route::get('/Mutasi', [MutasiController::class, 'index'])->name('mutasi');
    Route::get('/Mutasi/id', [MutasiController::class, 'getJenis'])->name('mutasi-filter');
    Route::post('Crate/Mutasi', [MutasiController::class, 'create'])->name('mutasi-create');
    Route::get('riwayat/mutasi', [MutasiController::class, 'riwayatmutasi'])->name('mutasi-riwayat');
    Route::get('mutasi/delete/{id}', [MutasiController::class, 'delete'])->name('mutasi-delete');
    Route::get('laporan/mutasi', [MutasiController::class, 'laporanMutasi'])->name('mutasi-laporan');
    Route::post('filter/date/mutasi', [MutasiController::class, 'filterDateMutasi'])->name('mutasi-filter-date');
    Route::get('cetak/mutasi/{startDate}/{endDate}', [MutasiController::class, 'cetakMutasi'])->name('mutasi-cetak');
    Route::get('mutasi/show/{id}', [MutasiController::class, 'edit'])->name('mutasi-edit');
    Route::put('mutasi/update/{id}', [MutasiController::class, 'update'])->name('mutasi-update');

    // Detail Mutasi Dari ID BARANG
    Route::get('Mutasi-Detail/{id}', [MutasiController::class, 'DetailBarangMutasi'])->name('detail-Barang-Mutasi');

    //--selesai route admin--//
});

//-- SEMUA ROUTE ROLE STAFF ( ROLE 3)--//

Route::middleware(['auth', 'check.role:2,3'])->group(function () {
    //SIDEBAR STAFF /ROLE 3
    Route::get('/peminjaman/form', function () {
        return view('peminjaman.form');
    });

    Route::get('/peminjaman/riwayat', function () {
        return view('peminjaman.riwayat');
    });

    //PINJAM NEW
    Route::resource('pinjamUang', PinjamUang::class)->parameters([
        'edit' => 'id',
        'update' => 'id',
        'destroy' => 'id',
    ])->name('*', 'Pinjam-Uang');
    Route::get('pinjamuang/find/{id}', [PinjamUang::class, 'getJenis']);
    Route::get('/pinjam/formulir', function () {
        return view('pinjam.formulir');
    });
    Route::get('/pinjam/formulir/{id}', [PinjamController::class, 'index'])->name('pinjam.formulir');
    Route::get('/inputpinjam/{id}', 'App\Http\Controllers\PinjamController@create')->name('inputpinjam');
    Route::POST('inputpinjam', 'App\Http\Controllers\PinjamController@create')->name('inputpinjam');
    Route::get('/pinjam', [PinjamController::class, 'pinjamstaff'])->name('staff/pinjam');

    //PEMINJAMAN STAFF
    Route::POST('inputpeminjaman', 'App\Http\Controllers\PeminjamanController@create')->name('inputpeminjaman');
    Route::get('/peminjaman/form', [PeminjamanController::class, 'index']);
    Route::get('/peminjaman/konfirmasi/{id}', [PeminjamanController::class, 'detail_konfirmasi']);

    //RIWAYAT PEMINJAM staff
    Route::get('/peminjaman', [PeminjamanController::class, 'peminjamanstaff'])->name('staff/peminjaman');
    Route::get('/riwayat', [PinjamController::class, 'riwayatstaff'])->name('staff/riwayat'); //
    Route::get('/download/{surat_pinjam}', [PeminjamanController::class, 'download']);
    Route::get('/detailbarang/{id}', [PeminjamanController::class, 'detail_barang']);
    Route::get('/detailriwayat/{id}', [PeminjamanController::class, 'detail_riwayat']);

    //STATUS USER staff

    //DATA ASET staff
    Route::get('/cekdata', [BarangController::class, 'cekdata'])->name('cekdata');
    Route::post('/Keranjang/Peminjaman/', [KeranjangController::class, 'isiKeranjang'])->name('isi-keranjang');
    Route::get('/keranjang', [KeranjangController::class, 'index'])->name('keranjang-index');
    Route::get('/keranjang/update/{id}', [KeranjangController::class, 'updateCart'])->name('keranjang-update');
    //--selesai route staff--//


    Route::get('/data-user', function () {
        return view('datauser.index');
    });

    Route::get('/data-user/form', function () {
        return view('datauser.form');
    });

    Route::get('/data-admin/form', function () {
        return view('dataadmin.form');
    });

    Route::get('/data-admin', function () {
        return view('dataadmin.index');
    });

    Route::get('/data-kepala/form', function () {
        return view('datakepala.form');
    });

    Route::get('/data-kepala', function () {
        return view('datakepala.index');
    });

    //DATA AKUN USER
    Route::get('/data-user', [UserController::class, 'index']); //menampilkan data user
    Route::POST('/data-user', 'App\Http\Controllers\UserController@create')->name('data-user');
    Route::get('/data-user/edit/{id}', 'App\Http\Controllers\UserController@edituser')->name('@edituser');
    Route::post('/data-user/update/{id}', 'App\Http\Controllers\UserController@updateuser')->name('updateuser');
    Route::get('/data-user/hapus/{id}', 'App\Http\Controllers\UserController@hapususer')->name('hapususer');

    //DATA AKUN ADMIN
    Route::POST('/data-admin', 'App\Http\Controllers\UserController@create')->name('data-admin');
    Route::get('/data-admin', [UserController::class, 'dataadmin'])->name('data-admin');
    Route::get('/data-admin/edit/{id}', 'App\Http\Controllers\UserController@editadmin')->name('editadmin');
    Route::post('/data-admin/update/{id}', 'App\Http\Controllers\UserController@updateadmin')->name('updateadmin');
    Route::get('/data-admin/hapus/{id}', 'App\Http\Controllers\UserController@hapusadmin')->name('hapusadmin');

    //DATA AKUN BENDAHARA
    Route::POST('/data-kepala', 'App\Http\Controllers\UserController@create')->name('data-kepala');
    Route::get('/data-kepala', [UserController::class, 'datakepala'])->name('data-kepala');
    Route::get('/data-kepala/edit/{id}', 'App\Http\Controllers\UserController@editkepala')->name('editkepala');
    Route::post('/data-kepala/update/{id}', 'App\Http\Controllers\UserController@updatekepala')->name('updatekepala');
    Route::get('/data-kepala/hapus/{id}', 'App\Http\Controllers\UserController@hapuskepala')->name('hapuskepala');
});

//--ROUTE ROLE ADMIN DAN BENDAHARA (ROLE 1 DAN 2) --//

Route::middleware(['auth', 'check.role:1,3'])->group(function () {
    //LAPORAN
    Route::get('/laporan/asetbergerak', [BarangController::class, 'laporanasetbergerak']);
    Route::get('/laporan/asetbergerak', function () {
        return view('laporan.asetbergerak');
    });

    //MENAMPILKAN VIEW LAPORAN
    Route::get('/laporan/barangmasuk', [BarangMasukController::class, 'laporanbarangmasuk']);
    Route::get('/laporan/barangkeluar', [BarangKeluarController::class, 'laporanbarangkeluar']);
    Route::get('/laporan/asetbergerak', [BarangController::class, 'laporanasetbergerak']);
    Route::get('/laporan/asettidakbergerak', [BarangController::class, 'laporanasettidakbergerak']);
    Route::get('/laporan/perlengkapan', [BarangController::class, 'laporanasetperlengkapan']);
    Route::get('/laporan/peralatan', [BarangController::class, 'laporanasetperalatan']);
    Route::get('/laporan/peminjaman', [PinjamController::class, 'laporanpeminjaman']);
    Route::post('laporan/barangkeluar', 'App\Http\Controllers\BarangKeluarController@sortir')->name('barangkeluar');
    Route::get('/laporan/menu', function () {
        return view('laporan.menu');
    });

    //MENAMPILKAN FILTER DAN CETAK LAPORAN
    //LAPORAN ASET BERGERAK
    Route::post('/filterasetbergerak', 'App\Http\Controllers\BarangController@sortirasetbergerak');
    Route::get('/laporanasetbergerak/{start}/{end}', 'App\Http\Controllers\BarangController@cetakLaporanBergerak');

    //LAPORAN ASET TIDAK BERGERAK
    Route::post('/filterasettidakbergerak', 'App\Http\Controllers\BarangController@sortirasettidakbergerak');
    Route::get('/laporanasettidakbergerak/{start}/{end}', 'App\Http\Controllers\BarangController@cetakLaporanTidakBergerak');

    //LAPORAN PERALATAN
    Route::post('/filterasetperalatan', 'App\Http\Controllers\BarangController@sortirasetperalatan');
    Route::get('/laporanasetperalatan/{start}/{end}', 'App\Http\Controllers\BarangController@cetakLaporanPeralatan');

    //LAPORAN PERLENGKAPAN
    Route::post('/filterasetperlengkapan', 'App\Http\Controllers\BarangController@sortirasetperlengkapan');
    Route::get('/laporanasetperlengkapan/{start}/{end}', 'App\Http\Controllers\BarangController@cetakLaporanPerlengkapan');

    //LAPORAN BARANG KELUAR
    Route::post('/filterbarangkeluar', 'App\Http\Controllers\BarangKeluarController@sortirkeluar');
    Route::get('/laporanbarangkeluar/{start}/{end}', 'App\Http\Controllers\BarangKeluarController@cetakLaporan');

    //LAPORAN BARANG MASUK
    Route::post('/filterbarangmasuk', 'App\Http\Controllers\BarangMasukController@sortirmasuk');
    Route::get('/laporanbarangmasuk/{start}/{end}', 'App\Http\Controllers\BarangMasukController@cetakLaporanBarangMasuk');

    //LAPORAN PEMINJAMAN
    Route::post('/filterpeminjaman', 'App\Http\Controllers\PinjamController@sortirpeminjaman');
    Route::get('/laporanpeminjaman/{start}/{end}', 'App\Http\Controllers\PinjamController@cetakLaporanPeminjaman');

    //--selesai role admin & BENDAHARA--//
});

//SELECT 2 Barang BAGIAN FORM PEMINJAMAN STAFF
Route::get('/barang/select2', [BarangController::class, 'select2Barang'])->name('select.barang');

// Filter Data
Route::get('/Filter/{data}', [StatusController::class, 'filter'])->name('filter-data');
Route::get('delete/notif/{id}', function ($id) {
    Pinjam::find($id)->notifications()->delete();
    return redirect()->back();
})->name('delete-notif');

//-- SEMUA ROUTE ROLE BENDAHARA ( ROLE 2)--//
Route::middleware(['auth', 'check.role:3'])->group(
    function () {
        //PEMINJAMAN//STATUS YG GANTI BENDAHARA
        Route::get('/status_setuju/{kode_peminjaman}', 'App\Http\Controllers\PeminjamanController@status_setuju');
        Route::get('/status_ditolak/{kode_peminjaman}', 'App\Http\Controllers\PeminjamanController@status_ditolak');


        //RIWAYAT PEMINJAM BENDAHARA
        Route::get('/kepalaunit/pengajuan', [PinjamController::class, 'pengajuan']);
        Route::get('/detailpengajuan/{id}', [PeminjamanController::class, 'detail_pengajuan']);
        Route::get('/kepalaunit/riwayat', [PinjamController::class, 'riwayatkepala']); //


        //PENCATATAN STOK/BARANG KELUAR BENDAHARA
        Route::get('/pencatatan/barangkeluar', [BarangKeluarController::class, 'databarangkeluar']);

        //PENCATATAN STOK/BARANG MASUK BENDAHARA
        Route::get('/pencatatan/barangmasuk', [BarangMasukController::class, 'databarangmasuk']);

        //TAMPIL DATA ASET BENDAHARA
        Route::get('/aset/bergerak', [BarangController::class, 'asetbergerak']);
        Route::get('/aset/tidakbergerak', [BarangController::class, 'asettidakbergerak']);
        Route::get('/aset/peralatan', [BarangController::class, 'asetperalatan']);
        Route::get('/aset/perlengkapan', [BarangController::class, 'asetperlengkapan']);


        //--selesai route BENDAHARA--//
    }
);
