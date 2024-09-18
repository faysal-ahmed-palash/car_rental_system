<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\Admin\CarController as AdminCarController;
use App\Http\Controllers\Admin\RentalController as AdminRentalController;
use App\Http\Controllers\Admin\CustomerController as AdminCustomerController;

use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\CarController as FrontendCarController;
use App\Http\Controllers\Frontend\RentalController as FrontendRentalController;
use App\Http\Middleware\FrontendMiddleware;

// Route::get('/', function () {
//     return view('frontend.home');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';



Route::get('/admin', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.submit');


// Admin ROUTES
// Group admin routes with middleware to restrict access to admin users

Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Car management
    Route::resource('admin/cars', AdminCarController::class, ['as' => 'admin']);

    // Rental management
    Route::resource('admin/rentals', AdminRentalController::class, ['as' => 'admin']);

    // Customer management
    Route::resource('admin/customers', AdminCustomerController::class, ['as' => 'admin']);
});










// Frontend routes

// Static pages like Home, About, Contact
Route::get('/', [PageController::class, 'home'])->name('frontend.home');
Route::get('/about', [PageController::class, 'about'])->name('frontend.about');
Route::get('/rental', [PageController::class, 'rental'])->name('frontend.rental');
Route::get('/contact', [PageController::class, 'contact'])->name('frontend.contact');


Route::get('/customer/login', [PageController::class, 'showLoginForm'])->name('frontend.login');
Route::post('/customer/login', [PageController::class, 'login'])->name('frontend.login.submit');

Route::get('/car/search', [PageController::class, 'search'])->name('frontend.search');


Route::middleware(['auth', FrontendMiddleware::class])->group(function () {

    Route::get('cars', [FrontendCarController::class, 'index'])->name('cars.index');
    Route::get('cars/{car}', [FrontendCarController::class, 'show'])->name('cars.show');

    Route::get('/rentals/{rental}', [FrontendRentalController::class, 'show'])->name('rentals.show');
    
    Route::get('/rentals', [FrontendRentalController::class, 'index'])->name('rentals.index');
    Route::post('/rentals', [FrontendRentalController::class, 'store'])->name('rentals.store');
    
    Route::patch('/rentals/{rental}', [FrontendRentalController::class, 'update'])->name('rentals.update');
    Route::delete('/rentals/{rental}', [FrontendRentalController::class, 'destroy'])->name('rentals.destroy');

});