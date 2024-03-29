<?php

use App\Http\Controllers\Auth\EmailVerificationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
// use App\Http\Livewire\FindUsername;
// use App\Http\Livewire\NoticeUsername;
use App\Http\Controllers\CheckController;
use App\Http\Controllers\FindUsernameController;
use App\Http\Controllers\UserPassController;
use App\Http\Contorllers\FindUserPass;
use App\Http\Controllers\UserPassInput;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\PhotoLoadController;
use App\Http\Controllers\StructureController;
use App\Http\Controllers\StructureDetailController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\JjimController;
use App\Http\Controllers\UpdateUserInfoController;
use App\Http\Controllers\NavController;
use App\Http\Controllers\SocialController;

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
})->name('login.get');

Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::post('/photo', [PhotoController::class, 'store']);

Route::get('/', function () {
    return redirect('welcome');
})->name('welcome');

Route::get('profileUUp',[ProfileController::class, 'goPro'])->name('userpro');

Route::get('profileSUp',[ProfileController::class, 'sellerprofile'])->name('sellpro');

Route::post('/UpdatePassPost', [ProfileController::class, 'UpdatePassPost'])->name('up_pass');

Route::post('/toggle-dark-mode', [DarkModeController::class, 'toggleDarkMode'])->name('toggle-dark-mode');

Route::get('u_register',[RegisterController::class, 'u_register'])->name('user-register');
Route::get('sell_register',[RegisterController::class, 'seller_register'])->name('seller-register');

// Route::get('/find-username', [FindUsername::class, '__invoke'])->name('find-username');
// Route::get('/notice-username', [NoticeUsername::class, '__invoke'])->name('notice-username');

Route::get('/find-username', [FindUsernameController::class, 'index'])->name('find-username');
Route::post('/find-username', [FindUsernameController::class, 'findUsername'])->name('find-username.submit');

Route::get('/find-userpass', [FindUserPass::class, '__invoke'])
    ->name('find-userpass')
    ->middleware('checkEmail');

Route::get('/find-userpassinput', [UserPassInput::class, 'render'])->name('find-userpassinput');


Route::get('/check-id', [CheckController::class, 'checkId'])->name('check-id');
Route::get('/checkLicense', [CheckController::class, 'checkLicense'])->name('checkLicense');

Route::get('/chk_phone_no', [UserController::class, 'chk_phone_no'])->name('profile.chk_phone_no');

Route::post('/update-password', [ResetPasswordController::class, 'update'])->name('updatePassword');
Route::post('/password-reset',[ResetPasswordController::class, 'resetps'])
    ->name('password-reset')
    ->middleware('checkEmail');


//탈퇴
Route::get('/chk-del-user', [UserController::class, 'chkDelUser'])->name('profile.chk_del_user');
Route::post('/chk-del-user-post',[UserController::class, 'chkDelUserPost'])->name('profile.chk_del_user.post');

//건물 작성
Route::post('/s-insert-post',[StructureController::class, 'structInsertStore'])->name('struct.insert.post');

Route::get('/sDetail/{s_no}', [StructureController::class, 'structInsertStore'])->name('struct.detail.get'); // 이거 안쓰는건가..??
//건물 상세
Route::get('/sDetail/{s_no}', [StructureDetailController::class, 'stateInfo'])->name('struct.detail');

Route::get('/welcome', [PhotoLoadController::class, 'index'])->name('welcome.com');
Route::get('/photos/more/{lastPhotoId}', [PhotoLoadController::class, 'loadMorePhotos']);

Route::get('/sellerphone/{s_no}',[UserController::class, 'sellerPhone'])->name('sellerPhone');
Route::get('/map', [MapController::class,'map'])->name('map.map');

//찜
Route::get('/jjims', [JjimController::class, 'store'])->name('jjims.store');


Route::post('/updateuserinfo', [UpdateUserInfoController::class, 'updateUserInfo'])->name('update.userinfo.post');
Route::get('/logout', [UserController::class, 'logout'])->name('user.logout');

Route::get('/user/profile', [UpdateUserInfoController::class, 'printMyBuilding'])->name('profile.com');

Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])->name('verification.verify');

Route::get('/info',[NavController::class, 'info'])->name('info');

Route::get('/sellers_info',[NavController::class, 'sellers_info'])->name('sellers_info');

// 페이스북 로그인
Route::get('auth/facebook',[SocialController::class, 'facebookpage']);;
Route::get('auth/facebook/callback',[SocialController::class, 'facebookredirect']);

// 건물 수정
Route::get('/sDetail/up/{s_no}', [StructureController::class, 'structEdit'])->name('struct.edit');
Route::put('/sDetail/up/{s_no}', [StructureController::class, 'structUpdate'])->name('struct.update');

// Route::get('/{site}/redirect',['as'=>'redirect','user'=>'Auth\FacebookController@redirectToProvider']);
// Route::get('/{site}/callback',['as'=>'redirect','user'=>'Auth\FacebookController@handlerProviderCallback']);


Route::get('/login/kakao',[SocialController::class,'redirectToKakao'])->name('login.kakao');
Route::get('/login/kakao/callback',[SocialController::class,'handleKakaoCallback']);

//검색 체크박스
Route::get('/search', [PhotoLoadController::class, 'checkBoxGet'])->name('search.get');
Route::post('/search', [PhotoLoadController::class, 'checkBoxPost'])->name('search.post');
