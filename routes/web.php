<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use Database\Seeders\LevelSeeder;

Route::get('/', [WelcomeController::class,'index']);

Route::group(['prefix' => 'user'], function() {
    Route::get('/', [UserController::class, 'index']);          // menampilkan halaman awal user
    Route::post('/list', [UserController::class, 'list']);      // menampilkan data user dalam bentuk json untuk datatables
    Route::get('/create', [UserController::class, 'create']);   // menampilkan halaman form tambah user
    Route::post('/', [UserController::class, 'store']);         // menyimpan data user baru
    Route::get('/{id}', [UserController::class, 'show']);       // menampilkan detail user
    Route::get('/{id}/edit', [UserController::class, 'edit']);  // menampilkan halaman form edit user
    Route::put('/{id}', [UserController::class, 'update']);     // menyimpan perubahan data user
    Route::get('/{id}/edit', [UserController::class, 'edit']);  // menampilkan halaman form edit user
    Route::delete('/{id}', [UserController::class, 'destroy']); // menghapus data user
});

Route::group(['prefix' => 'level'], function() {
    Route::get('/', [LevelController::class, 'index']);          // menampilkan halaman awal user
    Route::post('/list', [LevelController::class, 'list']);      // menampilkan data user dalam bentuk json untuk datatables
    Route::get('/create', [LevelController::class, 'create']);   // menampilkan halaman form tambah user
    Route::post('/', [LevelController::class, 'store']);         // menyimpan data user baru
    Route::get('/{id}', [LevelController::class, 'show']);       // menampilkan detail user
    Route::get('/{id}/edit', [LevelController::class, 'edit']);  // menampilkan halaman form edit user
    Route::put('/{id}', [LevelController::class, 'update']);     // menyimpan perubahan data user
    Route::get('/{id}/edit', [LevelController::class, 'edit']);  // menampilkan halaman form edit user
    Route::delete('/{id}', [LevelController::class, 'destroy']); // menghapus data user
});

Route::group(['prefix' => 'kategori'], function() {
    Route::get('/', [KategoriController::class, 'index']);          // menampilkan halaman awal kategori barang
    Route::post('/list', [KategoriController::class, 'list']);      // menampilkan data kategori barang dalam bentuk json untuk datatables
    Route::get('/create', [KategoriController::class, 'create']);   // menampilkan halaman form tambah kategori barang
    Route::post('/', [KategoriController::class, 'store']);         // menyimpan data kategori barang baru
    Route::get('/{id}', [KategoriController::class, 'show']);       // menampilkan detail kategori barang
    Route::get('/{id}/edit', [KategoriController::class, 'edit']);   // menampilkan halaman form edit kategori barang
    Route::put('/{id}', [KategoriController::class, 'update']);      // menyimpan perubahan data kategori barang
    Route::delete('/{id}', [KategoriController::class, 'destroy']);  // menghapus data kategori barang
});

Route::group(['prefix' => 'barang'], function() {
    Route::get('/', [BarangController::class, 'index']);          // menampilkan halaman awal kategori barang
    Route::post('/list', [BarangController::class, 'list']);      // menampilkan data kategori barang dalam bentuk json untuk datatables
    Route::get('/create', [BarangController::class, 'create']);   // menampilkan halaman form tambah kategori barang
    Route::post('/', [BarangController::class, 'store']);         // menyimpan data kategori barang baru
    Route::get('/{id}', [BarangController::class, 'show']);       // menampilkan detail kategori barang
    Route::get('/{id}/edit', [BarangController::class, 'edit']);   // menampilkan halaman form edit kategori barang
    Route::put('/{id}', [BarangController::class, 'update']);      // menyimpan perubahan data kategori barang
    Route::delete('/{id}', [BarangController::class, 'destroy']);  // menghapus data kategori barang
});

Route::group(['prefix' => 'stok'], function() {
    Route::get('/', [StokController::class, 'index']);          // menampilkan halaman awal kategori barang
    Route::post('/list', [StokController::class, 'list']);      // menampilkan data kategori barang dalam bentuk json untuk datatables
    Route::get('/create', [StokController::class, 'create']);   // menampilkan halaman form tambah kategori barang
    Route::post('/', [StokController::class, 'store']);         // menyimpan data kategori barang baru
    Route::get('/{id}', [StokController::class, 'show']);       // menampilkan detail kategori barang
    Route::get('/{id}/edit', [StokController::class, 'edit']);   // menampilkan halaman form edit kategori barang
    Route::put('/{id}', [StokController::class, 'update']);      // menyimpan perubahan data kategori barang
    Route::delete('/{id}', [StokController::class, 'destroy']);  // menghapus data kategori barang
});

// Route::get('login', [AuthController::class, 'index'])->name('login');
// Route::get('register', [AuthController::class, 'register'])->name('register');
// Route::post('proses_login', [AuthController::class, 'proses_login'])->name('proses_login');
// Route::get('logout', [AuthController::class, 'logout'])->name('logout');
// Route::post('proses_register', [AuthController::class, 'proses_register'])->name('proses_register');

// // kita atur juga untuk middleware menggunakan group routing
// // didalamnya terdapat group untuk mengecek kondisi login
// // jika user yang login merupakan admin maka akan diarahkan ke AdminController
// // jika user yang login merupakan manager maka akan diarahkan ke UserController

// Route::group(['middleware' => ['auth']], function () {

//     Route::group((['middleware' => ['cek_login:1']]), function () {
//         Route::resource('admin', AdminController::class);
//     });
//     Route::group((['middleware' => ['cek_login:2']]), function () {
//         Route::resource('manager', ManagerController::class);
//     });
// });

Route::get('login', [AuthController::class, 'index'])->name('login');
Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('proses_login', [AuthController::class, 'proses_login'])->name('proses_login');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::post('proses_register', [AuthController::class, 'proses_register'])->name('proses_register');

// Grup middleware 'auth' untuk melindungi route admin dan manager
Route::group(['middleware' => ['auth']], function () {

    Route::group(['middleware' => ['cek_login:1']], function () {
        Route::resource('admin', AdminController::class);
    });

    Route::group(['middleware' => ['cek_login:2']], function () {
        Route::resource('manager', ManagerController::class);
    });
});



// use App\Http\Controllers\KategoriController;
// use App\Http\Controllers\LevelController;
// use App\Http\Controllers\POSController;
// use App\Http\Controllers\UserController;
// use App\Http\Controllers\WelcomeController;
// use App\Models\User;
// use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/level', [LevelController::class, 'index']);
// Route::get('/kategori', [KategoriController::class, 'index']);
// Route::get('/user', [UserController::class, 'index'])->name('/user');

// Route::get('/user/tambah', [UserController::class, 'tambah'])->name('/user/tambah');
// Route::post('/user/tambah_simpan', [UserController::class, 'tambah_simpan'])->name('/user/tambah_simpan');
// Route::get('/user/ubah/{id}', [UserController::class, 'ubah'])->name('/user/ubah');
// Route::put('/user/ubah_simpan/{id}', [UserController::class, 'ubah_simpan'])->name('/user/ubah_simpan');
// Route::get('/user/hapus/{id}', [UserController::class, 'hapus'])->name('/user/hapus');

// Route::get('/kategori/create', [KategoriController::class, 'create']);
// Route::post('/kategori', [KategoriController::class, 'store']);

// Route::get('/kategori/create', [KategoriController::class, 'create'])->name('kategori.create');
// Route::get('/kategori/edit/{id}', [KategoriController::class, 'edit'])->name('kategori.edit');
// Route::put('/kategori/edit_simpan/{id}', [KategoriController::class, 'edit_simpan'])->name('kategori.edit_simpan');

// Route::get('/kategori/hapus/{id}', [KategoriController::class, 'hapus'])->name('kategori.hapus');

// Route::post('/level/store', [LevelController::class, 'store'])->name('/level/store');
// Route::get('/level/create', [LevelController::class, 'create'])->name('level.create');

// Route::resource('m_user', POSController::class);

// Route::get('/', [WelcomeController::class, 'index']);
