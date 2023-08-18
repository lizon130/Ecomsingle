<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home');
});

Route::controller(ClientController::class)->group(function () {
    Route::get('/category/{id}/{slug}', 'category')->name('category');
    Route::get('/product-details/{id}/{slug}', 'singleproduct')->name('singleproduct');
    Route::post('/add-product-to-cart', 'addproductTocart')->name('addproductTocart');
    Route::get('/user-profile', 'userprofile')->name('userprofile');
});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::controller(ClientController::class)->group(function () {


        Route::get('/user-profile', 'userprofile')->name('userprofile');
        Route::get('/user-profile/pending-orders', 'pendingorders')->name('pendingorders');
        Route::get('/user-profile/history', 'history')->name('history');
        Route::get('/add-to-cart', 'addtocart')->name('addtocart');
        Route::get('/add-to-checkout', 'checkout')->name('checkout');
        Route::post('/place-order', 'placeorder')->name('placeorder');

        Route::get('/remove-cart-item/{id}', 'removecartitem')->name('removecartitem');
        Route::get('/shipping-address', 'getshippingAdd')->name('getshippingAdd');
        Route::post('/add-shipping-address', 'addshippingAdd')->name('addshippingAdd');
    });
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'role:user'])->name('dashboard');

Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::controller(DashboardController::class)->group(function () {
        Route::get('/admin/dashboard', 'index')->name('admindashboard');
    });

    Route::controller(CategoryController::class)->group(function () {
        Route::get('/admin/All-category', 'index')->name('allcategory');
        Route::get('/admin/Add-category', 'addcategory')->name('addcategory');
        Route::post('/admin/storecategory', 'storecategory')->name('storecategory');

        Route::get('/admin/editcategory/{id}', 'editcategory')->name('editcategory');
        Route::post('/admin/updatecategory', 'updatecategory')->name('updatecategory');
        Route::get('/admin/deletecategory/{id}', 'deletecategory')->name('deletecategory');
    });

    Route::controller(SubCategoryController::class)->group(function () {
        Route::get('/admin/All-subcategory', 'index')->name('allsubcategory');
        Route::get('/admin/Add-subcategory', 'addsubcategory')->name('addsubcategory');
        Route::post('/admin/store-subcategory', 'storesubcategory')->name('storesubcategory');
        Route::get('/admin/edit-subcategory/{id}', 'editsubcat')->name('editsubcat');
        Route::get('/admin/delete-subcategory/{id}', 'deletesubcat')->name('deletesubcat');
        Route::post('/admin/update-subcategory', 'updatesubcat')->name('updatesubcat');
    });

    Route::controller(ProductController::class)->group(function () {
        Route::get('/admin/All-product', 'index')->name('allproduct');
        Route::get('/admin/Add-product', 'addproduct')->name('addproduct');
        Route::post('/admin/store-product', 'storeproduct')->name('storeproduct');
        Route::get('/admin/edit-product-img/{id}', 'editproductimg')->name('editproductimg');
        Route::post('/admin/update-product-img', 'updateproductimg')->name('updateproductimg');
        Route::get('/admin/edit/{id}', 'edit')->name('edit');
        Route::post('/admin/update-product', 'updateproduct')->name('updateproduct');
        Route::get('/admin/delete-product/{id}', 'deletepro')->name('deletepro');
    });

    Route::controller(OrderController::class)->group(function () {
        Route::get('/admin/pending-order', 'index')->name('pendingorder');
        Route::get('/admin/completed-order', 'completedorder')->name('completedorder');
        Route::get('/admin/cancel-order', 'cancelorder')->name('cancelorder');
    });
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
