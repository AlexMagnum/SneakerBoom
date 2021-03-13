<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GoodsController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ContactController;
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

Route::get('/', [MainController::class, 'index'])->name('home');

Route::get('contact', function () {
    return view('Front/contact');
})->name('contact');
Route::get('privacypolicy', [MainController::class, 'Privacy'])->name('privacy');
Route::get('aboutus', [MainController::class, 'AboutUs'])->name('aboutus');
Route::get('faq', [MainController::class, 'Faq'])->name('faq');
Route::get('payment', [MainController::class, 'Payment'])->name('payment');
Route::get('delivery', [MainController::class, 'Delivery'])->name('delivery');

Route::get("addnewsletter", [Controller::class, 'addNewsletter'])->name('addnewsletter');
Route::get('sendcontact', [Controller::class, 'sendContact'])->name('sendcontact');


Route::get('product/',[ProductController::class,'showAll'])->name('products');
Route::get('product/{id}', [ProductController::class, 'show'])->where('id', '[0-9]+')->name('single');
Route::get('product/filter/',[ProductController::class,'filter']);
Route::get('product/raiting/{id}',[ProductController::class, 'ProductRaiting'])->name('productraiting');

Route::get('category/{id}', [CategoryController::class, 'categoryView'])->where('id', '[0-9]+');
Route::get('category/{idc}/{idsc}', [CategoryController::class, 'subcategoryView'])->where('idc', '[0-9]+')
->where('idsc', '[0-9]+');

Route::get('add-to-cart/{id}/',[CartController::class, 'AddToCart'])->where('id', '[0-9]+')
   ->name('addtocart');
Route::get('cart/',[CartController::class, 'Cart'])->name('shoppingcart');
Route::get('reduce/{id}', [CartController::class, 'getReduceByOne'])->where('id', '[0-9]+')->name('reduceone');
Route::get('remove/{id}', [CartController::class, 'getRemoveItem'])->where('id', '[0-9]+')->name('removeall');
Route::get('increseItem/{id}', [CartController::class, 'increseItems'])->where('id', '[0-9]+')->name('increseitems');
Route::get('clear-cart', [CartController::class, 'cleatCart'])->name('clearcart');
Route::get('order', [CartController::class, 'order'])->name('order');
Route::post('sucsecc-order',[CartController::class, 'sucseccOrder'])->name('sucseccorder');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('profile/',[Controller::class,'profile'])->name('profile');
    Route::post('profile-update/',[Controller::class,'profileUpdate'])->name('profileupdate');
    Route::get('delivery-address/',[Controller::class,'deliveryAddress'])->name('deliveryaddress');
    Route::post('delivery-address-update/',[Controller::class,'deliveryAddressUpdate'])->name('deliveryaddressupdate');
    Route::get('change-password/',[Controller::class,'changePassword'])->name('changepassword');
    Route::post('change-password-update/',[Controller::class,'changePasswordUpdate'])->name('changepasswordupdate');
    Route::get('view-orders/',[Controller::class,'viewOrders'])->name('vieworders');
});

Route::group(['middleware'=> ['role:admin|manager|redactor']], function (){
    Route::prefix('admin')->group(function (){
        Route::get('/dashboard',[AdminController::class,'Dashboard'])->name('dashboard');
    });
});

Route::group(['middleware'=> ['role:admin|manager']], function (){
    Route::prefix('admin')->group(function (){
        Route::resource('goods', GoodsController::class)->names([
            'index' => 'goods.view',
            'create' => 'goods.add',
            'store' => 'goods.save',
            'show' => 'goods.show',
            'edit' => 'goods.edit',
            'update' => 'goods.update',
            'destroy' => 'goods.delete'
        ]);
    });
});

Route::group(['middleware'=> ['role:admin|manager']], function (){
    Route::prefix('admin')->group(function (){
        Route::resource('orders', OrderController::class)->except([
            'create', 'store', 'destroy'
        ])->names([
            'index' => 'orders.view',
            'show' => 'orders.show',
            'edit' => 'orders.edit',
            'update' => 'orders.update',
        ]);
        Route::post('invoice/{id}',[OrderController::class, 'sendInvoice'])->name('invoice');
    });
});

Route::group(['middleware'=> ['role:admin']], function (){
    Route::prefix('admin')->group(function (){
        Route::resource('users', UsersController::class)->names([
            'index' => 'users.view',
            'create' => 'users.add',
            'store' => 'users.save',
            'show' => 'users.show',
            'edit' => 'users.edit',
            'update' => 'users.update',
            'destroy' => 'users.delete'
        ]);
    });
});

Route::group(['middleware'=> ['role:admin|redactor']], function (){
    Route::prefix('admin')->group(function (){
        Route::get('ui/', [AdminController::class, 'UI'])->name('ui');
        Route::put('ui/update', [AdminController::class, 'UIUpdate'])->name('uiupdate');
    });
});


Route::group(['middleware'=> ['role:admin|redactor']], function (){
    Route::prefix('admin')->group(function (){
        Route::resource('contacts', ContactController::class)->except([
            'create', 'store',
        ])->names([
            'index' => 'contacts.view',
            'show' => 'contacts.show',
            'edit' => 'contacts.edit',
            'update' => 'contacts.update',
            'destroy' => 'contacts.delete'
        ]);
    });
});

Route::group(['middleware'=> ['role:admin|redactor']], function (){
    Route::prefix('admin')->group(function (){
        Route::get('newsletter/', [AdminController::class, 'Newsletter'])->name('newsletter');
        Route::get('rss', [AdminController::class,'RSS'])->name('rss');
        Route::post('rsssend', [AdminController::class,'RSSSend'])->name('rsssend');
        Route::delete('newsremove/{id}', [AdminController::class, 'NewsRemove'])->name('newsremove');
    });
});

Auth::routes(['verify' => true]);
