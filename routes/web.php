<?php

use App\Http\Controllers\AgendaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\DinasController;
use App\Http\Controllers\GalleryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeAdminDashboard;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\KategoriPengaduanController;
use App\Http\Controllers\LoginRakyatController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\PetaWilayahController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RegisterRakyatController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\DaerahController;
use App\Http\Controllers\PerintahController;
use App\Http\Controllers\SendMailController;
use Illuminate\Support\Facades\Auth;

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

//admin
Route::get('/admin_pu', [LoginController::class,'showAdminLoginForm'])->name('login_admin');
Route::get('/admin_pu/login', [LoginController::class,'showAdminLoginForm'])->name('login_admin');
Route::get('/admin_pu/register', [RegisterController::class,'showAdminRegisterForm'])->name('register_admin');
Route::post('/admin_pu/login', [LoginController::class,'adminLogin']);
Route::post('/admin_pu/register', [RegisterController::class,'createAdmin']);
Route::get('/admin_pu/dashboard', [HomeAdminDashboard::class,'index'])->name('dashboard_admin');

Route::get('/admin_pu/dinas',[DinasController::class,'index']);
Route::post('admin_pu/dinas/show',[DinasController::class,'show']);

Route::get('/admin_pu/gallery',[GalleryController::class,'indexadmin']);
Route::post('/admin_pu/gallery/add',[GalleryController::class,'store']);

Route::get('/admin_pu/ganti_profile_perusahaan',[ProfileController::class,'indexadmin']);
Route::post('admin_pu/ganti_profile_perusahaan/show',[ProfileController::class,'show']);
Route::get('/admin_pu/ganti_profile_perusahaan/edit',[ProfileController::class,'edit']);
Route::post('/admin_pu/ganti_profile_perusahaan/change',[ProfileController::class,'update']);

Route::get('/admin_pu/agenda',[AgendaController::class,'indexadmin']);
Route::get('/admin_pu/agenda/create',[AgendaController::class,'create']);
Route::post('/admin_pu/agenda/show',[AgendaController::class,'show']);
Route::post('/admin_pu/agenda/store',[AgendaController::class,'store']);
Route::post('/admin_pu/agenda/edit',[AgendaController::class,'edit']);
Route::post('/admin_pu/agenda/update',[AgendaController::class,'update']);

Route::get('/admin_pu/berita',[BeritaController::class,'indexadmin']);
Route::get('/admin_pu/berita/create',[BeritaController::class,'create']);
Route::post('/admin_pu/berita/show',[BeritaController::class,'showadmin']);
Route::post('/admin_pu/berita/store',[BeritaController::class,'store']);
Route::get('/admin_pu/berita/edit/{id}',[BeritaController::class,'edit']);
Route::post('/admin_pu/berita/update',[BeritaController::class,'update']);
Route::post('/admin_pu/berita/destroy',[BeritaController::class,'destroy']);
Route::post('/admin_pu/berita/softdelete',[BeritaController::class,'softdeleted']);
Route::post('/admin_pu/berita/harddelete',[BeritaController::class,'harddeleted']);

Route::get('/admin_pu/jabatan',[JabatanController::class,'index']);
Route::post('/admin_pu/jabatan/edit',[JabatanController::class,'edit']);
Route::post('/admin_pu/jabatan/store',[JabatanController::class,'store']);
Route::post('/admin_pu/jabatan/update',[JabatanController::class,'update']);
Route::post('/admin_pu/jabatan/destroy',[JabatanController::class,'destroy']);
Route::post('/admin_pu/jabatan/softdelete',[JabatanController::class,'softdeleted']);
Route::post('/admin_pu/jabatan/harddelete',[JabatanController::class,'harddeleted']);

Route::get('/admin_pu/kategori_pengaduan',[KategoriPengaduanController::class,'index']);
Route::get('/admin_pu/kategori_pengaduan/create',[KategoriPengaduanController::class,'create']);
Route::post('/admin_pu/kategori_pengaduan/store',[KategoriPengaduanController::class,'store']);
Route::post('/admin_pu/kategori_pengaduan/edit',[KategoriPengaduanController::class,'edit']);
Route::post('/admin_pu/kategori_pengaduan/update',[KategoriPengaduanController::class,'update']);
Route::post('/admin_pu/kategori_pengaduan/destroy',[KategoriPengaduanController::class,'destroy']);
Route::post('/admin_pu/kategori_pengaduan/softdelete',[KategoriPengaduanController::class,'softdeleted']);
Route::post('/admin_pu/kategori_pengaduan/harddelete',[KategoriPengaduanController::class,'harddeleted']);

Route::get('/admin_pu/role',[RoleController::class,'index']);
Route::post('/admin_pu/role/edit',[RoleController::class,'edit']);
Route::post('/admin_pu/role/store',[RoleController::class,'store']);
Route::post('/admin_pu/role/update',[RoleController::class,'update']);

Route::get('/admin_pu/pengaduan',[PengaduanController::class,'indexadmin']);
Route::post('/admin_pu/pengaduan/show',[PengaduanController::class,'edit']);
Route::get('/admin_pu/pengaduan/download/{filename}',[PengaduanController::class,'getDownload']);
Route::post('/admin_pu/pengaduan/update',[PengaduanController::class,'update']);

Route::get('/admin_pu/peta_wilayah',[PetaWilayahController::class,'indexadmin']);
Route::post('/admin_pu/peta_wilayah/store',[PetaWilayahController::class,'store']);
Route::post('/admin_pu/peta_wilayah/show',[PetaWilayahController::class,'show']);
Route::get('/admin_pu/peta_wilayah/download/{filename}',[PetaWilayahController::class,'getDownload']);

Route::get('/admin_pu/surat_perintah',[PerintahController::class,'index']);
Route::get('/admin_pu/surat_perintah/create',[PerintahController::class,'create']);
Route::post('/admin_pu/surat_perintah/store',[PerintahController::class,'store']);
Route::post('/admin_pu/surat_perintah/show',[PerintahController::class,'show']);
Route::post('/admin_pu/surat_perintah/edit',[PerintahController::class,'edit']);
Route::post('/admin_pu/surat_perintah/update',[PerintahController::class,'update']);
Route::post('/admin_pu/surat_perintah/destroy',[PerintahController::class,'destroy']);
Route::post('/admin_pu/surat_perintah/softdelete',[PerintahController::class,'softdeleted']);
Route::post('/admin_pu/surat_perintah/harddelete',[PerintahController::class,'harddeleted']);
Route::get('/admin_pu/surat_perintah/download/{filename}',[PerintahController::class,'getDownload']);

Route::get('/admin_pu/daerah',[DaerahController::class,'index']);
Route::post('/admin_pu/daerah/edit',[DaerahController::class,'edit']);
Route::post('/admin_pu/daerah/update',[DaerahController::class,'update']);
Route::post('/admin_pu/daerah/store',[DaerahController::class,'store']);

Route::get('/admin_pu/send-mail', [\App\Http\Controllers\SendMailController::class, 'send']);

//masyarakat
Route::get('/', [ProfileController::class,'index'])->name('dashboard');
Route::get('/about', [ProfileController::class,'about']);
Route::get('/strukturorganisasi', [ProfileController::class,'struktureorganisasi']);
Route::get('/visimisi', [ProfileController::class,'visimisi']);
Route::get('/tugaspokok', [ProfileController::class,'tugaspokok']);
Route::get('/fungsi', [ProfileController::class,'fungsi']);
Route::get('/pengaduan', [PengaduanController::class,'index']);

Route::get('/create_pengaduan', [PengaduanController::class,'create'])->name('create_pengaduan');
Route::post('/create_pengaduan/store', [PengaduanController::class,'store']);

Route::get('/check_pengaduan', [LoginRakyatController::class,'showRakyatLoginForm'])->name('login_rakyat');
Route::get('/rakyat/login', [LoginRakyatController::class,'showRakyatLoginForm'])->name('login_rakyat');
Route::get('/rakyat/register', [RegisterRakyatController::class,'showRakyatRegisterForm'])->name('register_rakyat');
Route::post('/rakyat/login', [LoginRakyatController::class,'rakyatLogin']);
Route::post('/rakyat/register', [RegisterRakyatController::class,'createRakyat']);

Route::get('/gallery/rakyat',[GalleryController::class,'index']);
Route::get('/berita', [BeritaController::class,'index']);
Route::get('/berita/show/{id}', [BeritaController::class,'show']);
Route::get('/agenda', [AgendaController::class,'index']);
Route::get('/petawilayah', [PetaWilayahController::class,'index']);
Route::get('/petawilayah/show/{id}',[PetaWilayahController::class,'showrakyat']);


Auth::routes();
