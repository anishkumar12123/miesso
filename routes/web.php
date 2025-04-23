<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/',[HomeController::class,'Home']);
Route::get('/dashboard',[HomeController::class,'login_home'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/myorders',[HomeController::class,'myorders'])->middleware(['auth', 'verified']);
// Route::get('/dashboard', function () {
//     return view('home.index');
// })->middleware(['auth', 'verified'])->name('dashboard');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

route::get('admin/dashbord',[HomeController::class,'index'])->middleware(['auth','admin']);
route::get('view_cetegory',[AdminController::class,'view_cetegory'])->middleware(['auth','admin']);
route::post('add_category',[AdminController::class,'add_category'])->middleware(['auth','admin']);
route::get('delete_category/{id}',[AdminController::class,'delete_category'])->middleware(['auth','admin']);
route::get('edit_category/{id}',[AdminController::class,'edit_category'])->middleware(['auth','admin']);
route::post('update_category/{id}',[AdminController::class,'update_category'])->middleware(['auth','admin']);


route::get('add_product',[AdminController::class,'add_product'])->middleware(['auth','admin']);
route::post('upload_product',[AdminController::class,'upload_product'])->middleware(['auth','admin']);
route::get('product_view',[AdminController::class,'product_view'])->middleware(['auth','admin']);
route::get('delete_product/{id}',[AdminController::class,'delete_product'])->middleware(['auth','admin']);
route::get('update_product/{slug}',[AdminController::class,'update_product'])->middleware(['auth','admin']);
route::post('edit_product/{id}',[AdminController::class,'edit_product'])->middleware(['auth','admin']);
route::get('search_product',[AdminController::class,'search_product'])->middleware(['auth','admin']);




route::get('produc_details/{id}',[HomeController::class,'produc_details']);
route::get('shop',[HomeController::class,'shop']);
route::get('why',[HomeController::class,'why']);
route::get('testimonial',[HomeController::class,'testimonial']);
route::get('contact',[HomeController::class,'contact']);
Route::get('add_cart/{id}', [HomeController::class, 'add_cart'])->middleware('auth');
Route::get('mycart', [HomeController::class, 'mycart'])->middleware('auth');
Route::get('delete_cart/{id}', [HomeController::class, 'delete_cart'])->middleware('auth');

Route::post('comfirm_order', [HomeController::class, 'comfirm_order'])->middleware('auth');

Route::controller(HomeController::class)->group(function(){
    Route::get('stripe/{value}', 'stripe');
    Route::post('stripe/{value}', 'stripePost')->name('stripe.post');
});

Route::get('view_order', [AdminController::class, 'view_orders'])->middleware(['auth','admin']);
Route::get('on_the_way/{id}', [AdminController::class, 'on_the_way'])->middleware(['auth','admin']);
Route::get('delivered/{id}', [AdminController::class, 'delivered'])->middleware(['auth','admin']);
Route::get('print_pdf/{id}', [AdminController::class, 'print_pdf'])->middleware(['auth','admin']);






