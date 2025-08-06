    <?php

        use Illuminate\Support\Facades\Route;
        use Illuminate\Support\Facades\Auth;
        use App\Http\Controllers\Auth\RegisteredUserController;

    // Ruta pública principal
    Route::view('/', 'tienda')->name('tienda');


    Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
        })->name('logout');

    // Ruta protegida para dashboard
    Route::get('/dashboard', function () {
        abort_unless(in_array(auth()->user()->email, [
            'admin1@admin.com',
            'admin2@admin.com',
            'admin3@admin.com'
        ]), 403);

        return view('dashboard');
    })->middleware('auth')->name('dashboard');
    

    Route::view('/profile', 'welcome')->name('profile');

   
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store'])->name('register.store');
    require __DIR__.'/auth.php';
