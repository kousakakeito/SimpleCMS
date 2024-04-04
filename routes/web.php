<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashController;
use App\Http\Controllers\FrontController;

Route::get('/', function () {
    return view('auth.auth');
});
Route::get('/dashboard', function () {
    $username = Auth::user()->name; 
    return view('dashboard.dashboard', compact('username'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/login-form', [AuthController::class, 'showLoginForm']);
Route::get('/register-form', [AuthController::class, 'showRegisterForm']);
Route::get('/auth-form', [AuthController::class, 'showAuthForm']);

Route::get('/cate-form', [DashController::class, 'showCateForm']);
Route::post('/cate-changeform', [DashController::class, 'showCateChangeForm']);
Route::post('/cate-change', [DashController::class, 'changeCategory']);
Route::post('/cate-editform', [DashController::class, 'showCateEditForm']);
Route::post('/cate-update', [DashController::class, 'updateCategory']);
Route::post('/cate-deleteform', [DashController::class, 'showCateDeleteForm']);
Route::post('/cate-delete', [DashController::class, 'deleteCategory']);
Route::get('/cate-form2', [DashController::class, 'showCateForm2']);
Route::get('/notice-form', [DashController::class, 'showNoticeForm']);
Route::post('/notices/search', [DashController::class, 'searchNotices']);
Route::post('/notice-editform', [DashController::class, 'showNoticeEditForm']);
Route::post('/notice-update', [DashController::class, 'updateNotice']);
Route::post('/notice-deleteform', [DashController::class, 'showNoticeDeleteForm']);
Route::post('/notice-delete', [DashController::class, 'deleteNotice']);
Route::get('/notice-form2', [DashController::class, 'showNoticeForm2']);
Route::post('/image/upload', [DashController::class, 'imageStore']);
Route::get('/dash-form', [DashController::class, 'showDashForm']);
Route::post('/categories', [DashController::class, 'CateStore']);
Route::post('/notices', [DashController::class, 'NoticeStore']);
Route::get('/contact-form', [DashController::class, 'showContactForm']);
Route::post('/contact-deleteform', [DashController::class, 'showContactDeleteForm']);
Route::post('/contact-detail', [DashController::class, 'showContactDetailForm']);
Route::post('/contact-delete', [DashController::class, 'deleteContact']);
Route::get('/CMS/{username}', [DashController::class, 'show'])->name('user.show');


Route::get('/CMS/{username}/list-content', [FrontController::class, 'showListContentForm']);
Route::get('/CMS/{username}/next-listform', [FrontController::class, 'showNextListForm']);
Route::get('/CMS/{username}/back-listform', [FrontController::class, 'showBackListForm']);
Route::get('/CMS/{username}/detail-content', [FrontController::class, 'showDetailContentForm']);
Route::post('/CMS/{username}/detail-pageform', [FrontController::class, 'showPageDetailForm']);
Route::post('/CMS/{username}/notice-itemform', [FrontController::class, 'showItemDetailForm']);
Route::get('/CMS/{username}/contact-form', [FrontController::class, 'showContactForm']);
Route::post('/CMS/{username}/contact-form1', [FrontController::class, 'showContactForm1']);
Route::post('/CMS/{username}/contact-form2', [FrontController::class, 'storeContactForm']);




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';




