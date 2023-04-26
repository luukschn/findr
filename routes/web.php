<?php


use App\Http\Controllers\ScaleController;
use App\Http\Controllers\UserManagement\RegistrationController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserManagement\LoginController;
use App\Http\Controllers\UserManagement\ProfileController;

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

/* General */
Route::get('/', function () {
    return view('homepage');
});

Route::get('about', function () {
    return view('about');
});

// Route::get('/token', function (Request $request) {
// })

// Route::post('submit-scale', [ScaleController::class, 'submit']); //need to ensure that this can parse information dynamically and that it cannot parse content via a normal post request which doesnt
// fit the scale formats

/* user management */
Route::get('login', function () {
    if (Auth::check()) {
        return view('homepage');
    } else {
        return view('auth.login');
    }
});
Route::post('user/login', [LoginController::class, 'login']);

Route::get('logout', function() {
    Auth::logout();
    return redirect('/');
});

Route::get('register', function () {
    if (Auth::check()) {
        return view('homepage');
    } else {
        return view('auth.register');
    }
});
//TODO: check again if this is proper structure for posting or if there are better ways
// Route::group(['middleware' => 'web'], function() {
//     Route::post('user/register', [RegistrationController::class, 'submitRegistration'])->middleware('csrf');
// });
// Route::post('user/register', [RegistrationController::class, 'submitRegistration'])->middleware('csrf');
// Route::post('user/register', [RegistrationController::class, 'submitRegistration']);
// Route::group(['middleware' => 'web'], function() {
//     Route::post('user/register', [RegistrationController::class, 'submitRegistration'])->middleware('csrf');
// });
Route::middleware('web')->group(function () {
    Route::post('user/register', [RegistrationController::class, 'submitRegistration']);
});


// Route::middleware(['auth'])->group(function() {
    
    
// });

Route::get('profile/{id}', [ProfileController::class, 'get_profile'])->name('profile.show');
Route::post('profile/update', [ProfileController::class, 'update_profile']);

/* Research pages */
Route::get('research', function (){
    return view('research');
});


/* Friend finder */
Route::get('finder', function() {
    if (Auth::check()) {
        return view('finder.finder_home');
    } else {
        return redirect('login');
    }
});


/* Scales */
Route::get('scale/{scaleId}', function($scaleId) {
    return view('scales.scale-' . $scaleId);
})->name('scale');
Route::post('submit-scale', [ScaleController::class, 'process_scale_results']);

Route::get('scale/{scaleId}/result/{userId}', [ScaleController::class, 'show_results_individual']);
// Route::get('finder/{scaleId}', function() {
//     if (Auth::check()) {
//         return view('finder.scale', $scaleId); //figure out how to display correct scale based on id
//     } else {
//         return redirect('login');
//     }
// })

