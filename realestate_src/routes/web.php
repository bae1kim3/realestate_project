<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DarkModeController;
use App\Http\Controllers\RegisterController;
use App\Http\Livewire\FindUsername;
use App\Http\Livewire\NoticeUsername;
use App\Http\Controllers\CheckController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\UserPassController;
use App\Http\Livewire\FindUserPass;
use App\Http\Livewire\UserPassInput;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\PhotoLoadController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\StructureController;




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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [LoginController::class, 'login'])->name('login');
// Route::get('/seller-login', [LoginController::class, 'login'])->name('seller-login');

Route::post('/photo', [PhotoController::class, 'store']);

Route::get('/', function () {
    return redirect('welcome');
})->name('welcome');

Route::post('/UpdatePassPost', [ProfileController::class, 'UpdatePassPost'])->name('up_pass');

Route::post('/toggle-dark-mode', [DarkModeController::class, 'toggleDarkMode'])->name('toggle-dark-mode');

Route::get('u_register',[RegisterController::class, 'u_register'])->name('user-register');
Route::get('sell_register',[RegisterController::class, 'seller_register'])->name('seller-register');

Route::get('/find-username', [FindUsername::class, '__invoke'])->name('find-username');
// Route::post('/find-username', [UsernameController::class, 'findUsername'])->name('find-username.post');
Route::get('/notice-username', [NoticeUsername::class, '__invoke'])->name('notice-username');

Route::get('/find-userpass', [FindUserPass::class, '__invoke'])->name('find-userpass');
Route::post('/find-userpass', [UserPassController::class, 'findUserpass'])->name('find-userpass.post');

Route::get('/find-userpassinput', [UserPassInput::class, '__invoke'])->name('find-userpassinput');


Route::get('/check-id', [CheckController::class, 'checkId'])->name('check-id');
Route::get('/checkLicense', [CheckController::class, 'checkLicense'])->name('checkLicense');

Route::get('/chk_phone_no', [UserController::class, 'chk_phone_no'])->name('profile.chk_phone_no');

Route::post('/update-password', [ResetPasswordController::class, 'update'])->name('updatePassword');
Route::get('/password-reset',[ResetPasswordController::class, 'resetps'])->name('password-reset');


//탈퇴
Route::get('/chk-del-user', [UserController::class, 'chkDelUser'])->name('profile.chk_del_user');
Route::post('/chk-del-user-post',[UserController::class, 'chkDelUserPost'])->name('profile.chk_del_user.post');

//건물 수정, 삭제
Route::post('/s-insert-post',[StructureController::class, 'structInsertStore'])->name('struct.insert.post');

// 건물 상세 (임시)
Route::get('/sDetail', [StructureController::class, 'structDetail'])->name('struct.detail.get');

Route::get('/welcome', [PhotoLoadController::class, 'index'])->name('welcome');
Route::get('/photos/more/{lastPhotoId}', [PhotoLoadController::class, 'loadMorePhotos']);
Route::get('/search', [SearchController::class, 'search']);

// 지도
Route::get('/map', [MapController::class,'map'])->name('map.map');

// stat_option post
Route::post('/statoption/post', [StatOpController::class, 'statOpPost'])->name('stat.option.post');
