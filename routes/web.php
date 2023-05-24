<?php


use App\Http\Controllers\ScaleController;
use App\Http\Controllers\ScaleUploadController;
use App\Http\Controllers\UserManagement\RegistrationController;
use App\Models\Scale;
use App\Models\ScaleQuestion;
use App\Models\ScaleResult;
use Illuminate\Foundation\Auth\User;
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
    $user = User::find(Auth::id());

    $data = array();
    $data['is_admin'] = $user['is_admin'];

    $scales = Scale::get();
    $scale_results = ScaleResult::get();

    $data['scaleinfo'] = array();

    foreach ($scales as $scale) {
        $scale_id = $scale['scale_id'];

        $scale_result = ScaleResult::where('scale_id', $scale_id)->where('user_id', Auth::id())->first();

        if ($scale_result != null){
            $scale_progress = 'Finished';
        } else {
            $scale_progress = 'Not yet completed';
        }

        $data['scale_info'][] = [
            'scale_name_official' => $scale['officialName'],
            'scale_id' => $scale['scale_id'],
            'scale_progress' => $scale_progress
        ];
    }
    

    if (Auth::check()) {
        return view('finder.finder_home')->with('data', $data);
    } else {
        return redirect('login');
    }
})->name('finder');


/* Scales */
Route::get('scale/{scale_id}', function($scale_id) {
    // return view('scales.scale-' . $scale_id);
    $data = array();

    $data['scale'] = Scale::where('scale_id', $scale_id)->first();
    $data['questions'] = ScaleQuestion::where('scale_id', $scale_id)->get();

    //parse the CSV values and get the amount of options:
    
    $data['scale']['option-count'] = (substr_count($data['scale']['options'], ',') + 1);

    $options_array = explode($data['scale']['options'], ',');

    for ($i = 0; $i <= (count($options_array) - 1); $i++) {
        $options_array[$i] = trim($options_array[$i]);
    }

    $data['scale']['options'] = $options_array;


    return view('scales.scale_template')->with('data', $data);
})->name('scale');
Route::post('submit-scale', [ScaleController::class, 'process_scale_results']);

Route::get('scale/{scale_id}/result/{user_id}', [ScaleController::class, 'show_results_individual']);
// Route::get('finder/{scale_id}', function() {
//     if (Auth::check()) {
//         return view('finder.scale', $scale_id); //figure out how to display correct scale based on id
//     } else {
//         return redirect('login');
//     }
// })
Route::get('upload/scale', function() {
    $user = User::find(Auth::id()); //not sure if this should be done here
    if ($user != null) {
        if ($user->is_admin == 1) {
            return view('scales.scale_upload');
        } else {
            return redirect()->back();
        }
    } else {
        return redirect('login');
    }
});
Route::post('upload/scale/submit', [ScaleUploadController::class, 'process_scale_upload']);

