<?php

// Website Controllers
use App\Http\Controllers\website\ProductsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\website\MainController;
use App\Http\Controllers\website\ProfileController;
// Dashboard Controllers
use App\Http\Controllers\dashboard\DashboardMainController;

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

Auth::routes();

//Website MainController
// Home Page
Route::get('/',[MainController::class, 'home'])->name('home'); // Buttom Navbar
//About Page
Route::get('/about' , [MainController::class, 'about'])->name('about');
//contact Page
Route::get('/contact' , [MainController::class, 'contact'])->name('contact');
//cart page
Route::get('/cart', [MainController::class, 'cart'])->name('cart');
//profile Page
Route::get('/profile' , [MainController::class], 'profile')->name('profile');
//search Page
Route::get('/search' , [MainController::class, 'search'])->name('search');
//wishlist Page
Route::get('/wishlist',[MainController::class,'wishlist'])->name('wishlist');
//thankyou Page
Route::get('/thank-you' , [MainController::class, 'thankYou'])->name('thank-you');
//checkout Page
Route::get('/checkout' , [MainController::class , 'checkout'])->name('checkout');
// Catalogue Page
Route::get('/catalogue' , [MainController::class , 'catalogue'])->name('catalogue');
// Home WebSite Auth
Route::get('/home', [App\Http\Controllers\website\HomeController::class, 'index'])->name('home');
//*****-------------------- START Products Controller  route. --------------------*****//
Route::get('/shop',[ProductsController::class , 'shop'])->name('shop');
//*****-------------------- START Profile Controller  route. --------------------*****//
Route::get('/profile/{id}', [ProfileController::class , 'showProfile'])->name('showProfile');
Route::get('/profile/{id}/edit', [ProfileController::class , 'editProfile'])->name('editProfile');
Route::patch('/profile/{id}/update', [ProfileController::class , 'updateProfile'])->name('updateProfile');



//*****-------------------- START dashboard/admin route. --------------------*****//
Route::group([
    'middleware' => ['auth'/*, 'dashboard'*/]
], function () {

    Route::prefix('dashboard')->group(function () {
        //---------------- START dashboard home route ----------------//
        Route::get('/', [DashboardMainController::class, 'index'])->name('dashboard');
        //---------------- END dashboard home route ----------------//

        //

    });
});
//*****-------------------- END dashboard/admin route. --------------------*****//
