<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\NewProfileController;


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

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');


// questo raggruppa tutte le rotte che devono essere coperte da amministrazione facendo in modo che il nome della rotta inizi per admin.
// e che il prefisso prima di / sia admin nell'url
Route::middleware(['auth', 'verified'])
->name('admin.')
->prefix('admin')
->group(function() {
    // Le varie rotte di amministrazione
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('profile', NewProfileController::class)->parameters([
        'profile' => 'user:slug'
    ]);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
