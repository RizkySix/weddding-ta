<?php

use App\Constant\Constant;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\DecorationController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\ItemOrderController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\PackageDashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RatingParticipantController;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

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

Route::get('/', [HomepageController::class , 'homepage'])->name('homepage');

Route::middleware('auth')->group(function() {

    Route::middleware(['holder.only'])->group(function() {
        Route::get('/package' , [PackageController::class , 'index']);
        Route::get('/package/create' , [PackageController::class , 'create']);
        Route::post('/package/create' , [PackageController::class , 'store']);
        Route::get('/package/{package}/edit' , [PackageController::class , 'edit']);
        Route::put('/package/{package}/edit' , [PackageController::class , 'update']);
        Route::delete('/package/{package}/destroy' , [PackageController::class , 'destroy']);
        
        Route::get('/decoration' , [DecorationController::class , 'index']);
        Route::get('/decoration/create' , [DecorationController::class , 'create']);
        Route::post('/decoration/create' , [DecorationController::class , 'store']);
        Route::get('/decoration/{decoration}/edit' , [DecorationController::class , 'edit']);
        Route::put('/decoration/{decoration}/edit' , [DecorationController::class , 'update']);
        
    });
    
    Route::get('/booking/active', [PackageDashboardController::class , 'activeOrder'])->name('package.booking.active');
    Route::get('/booking/unactive', [PackageDashboardController::class , 'unActiveOrder'])->name('package.booking.unactive');
    Route::put('/booking/package/start/{booking}' , [BookingController::class , 'updateStartConfirm']);
    Route::put('/booking/package/end/{booking}' , [BookingController::class , 'updateEndConfirm']);
    
    Route::get('/booking/{package}' , [BookingController::class , 'index'])->name('booking.view');
    Route::get('/check-date' , [BookingController::class , 'checkDate']);
    Route::post('/booking' , [BookingController::class , 'store'])->name('post.booking');
    Route::get('/test' , [BookingController::class , 'test'])->name('test.test');
    
    Route::post('/rating/{package}' , [RatingParticipantController::class , 'storeRating'])->name('feedback.rating');
    
    
    Route::get('/item/orders' , [ItemOrderController::class , 'index'])->middleware('customer.only');
   Route::middleware(['holder.only'])->group(function() {
    Route::get('/admin/order/waiting' , [AdminOrderController::class , 'waitingOrder']);
    Route::get('/admin/order/paid' , [AdminOrderController::class , 'paidOrder']);
    Route::get('/admin/order/expired' , [AdminOrderController::class , 'expiredOrder']);
    
    Route::get('/admin/dashboard', [DashboardAdminController::class , 'dashboard']);
    Route::get('/admin/customer', [DashboardAdminController::class , 'allCustomer']);
    
    
    Route::post('/upload', [CatalogController::class , 'process'])->name('upload');
    Route::delete('/revert/{metadata}' , [CatalogController::class , 'revert'])->name('revert');
    Route::post('/reorder/{metadata}' , [CatalogController::class , 'reorder'])->name('reorder');
   });
});


/* BEDA DIBAWAH */
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



Route::get('/cache/{metadata}' , function($metadata) {
    return Cache::get($metadata);
});
require __DIR__.'/auth.php';
