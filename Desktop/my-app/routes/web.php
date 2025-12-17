<?php



use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{ReservationController, UserController};


// Routes login/logout admin
Route::get('login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('login', [UserController::class, 'login'])->name('login.submit');
Route::post('logout', [UserController::class, 'logout'])->name('logout');

// Routes protégées par auth
Route::middleware(['auth'])->prefix('admin')->group(function () {
    // Utilisateurs
    Route::get('users', [UserController::class, 'dashboard'])->name('users.index');
    Route::get('users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('users', [UserController::class, 'store'])->name('users.store');
    Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    // Réservations
    Route::resource('reservations', ReservationController::class);
});


Route::get('/reservation', [ReservationController::class, 'createPublic'])->name('reservation.create');
Route::post('/reservation', [ReservationController::class, 'storePublic'])->name('reservation.store');
// Optionnel : page d'accueil ou liste publique (si tu veux montrer toutes les réservations)
Route::get('/', function () {
    return view('public.reservation.create'); // par exemple une page d'accueil
});
