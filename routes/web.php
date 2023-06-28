<?php


use App\Http\Controllers\MatchingController;
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

/* user management */
Route::get('login', function () {
    if (Auth::check()) {
        return view('homepage');
    } else {
        return view('auth.login');
    }
})->name('login');
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

// apparently automatically redirects to login view
Route::group(['middleware' => 'auth'], function () {
    Route::get('profile/{id}', [ProfileController::class, 'get_profile'])->name('profile.show');
    Route::post('profile/update', [ProfileController::class, 'update_profile']);
});


/* Research pages */
Route::get('research', function (){
    return view('research');
});


/* Friend finder */
Route::group(['middleware' => 'auth'], function () {
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

            //TODO move to view
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

    
        return view('finder.finder_home')->with('data', $data);
    })->name('finder');
    Route::get('finder/match', [MatchingController::class, 'match_individual']);
});


/* Scales */
Route::get('scale/{scale_id}', function(Scale $scale) {
    //TODO improve structure
    $scale_id = $scale->scale_id;
    
    if (Auth::check()) {
        if (ScaleResult::where('scale_id', $scale_id)->where('user_id', Auth::id())->first() == null) {
            // return view('scales.scale-' . $scale_id);
            $data = array();
    
            $data['scale'] = Scale::where('scale_id', $scale_id)->first();
            $data['questions'] = ScaleQuestion::where('scale_id', $scale_id)->get();
    
            //parse the CSV values and get the amount of options:
            $data['scale']['option-count'] = (substr_count($data['scale']['options'], ',') + 1);
            
            $options_array = explode(',', $data['scale']['options']);
    
            for ($i = 0; $i <= (count($options_array) - 1); $i++) {
                $options_array[$i] = trim($options_array[$i]);
            }
    
            $data['scale']['options'] = $options_array;
    
            return view('scales.scale_template')->with('data', $data);
    
        } else {
            
            $controller = app(ScaleController::class);
            $response = $controller->callAction('show_results_individual', [$scale_id, Auth::id()]);
            return $response->render();
        }

    } else {
        $data = array();
    
        $data['scale'] = Scale::where('scale_id', $scale_id)->first();
        $data['questions'] = ScaleQuestion::where('scale_id', $scale_id)->get();

        //parse the CSV values and get the amount of options:
        $data['scale']['option-count'] = (substr_count($data['scale']['options'], ',') + 1);
        
        $options_array = explode(',', $data['scale']['options']);

        for ($i = 0; $i <= (count($options_array) - 1); $i++) {
            $options_array[$i] = trim($options_array[$i]);
        }

        $data['scale']['options'] = $options_array;

        return view('scales.scale_template')->with('data', $data);
    }

})->name('scale');

// Route::post('submit-scale', [ScaleController::class, 'process_scale_results']);
Route::post('submit-scale', function(Illuminate\Http\Request $request) {
    $ScaleController = app(ScaleController::class);
    // $formData = $request->all();
    if (Auth::check()) {
        $ScaleController->callAction('process_scale_results', [$request]);
    } else {
        $ScaleController->callAction('process_scale_results_no_auth', [$request]);
    }
});

Route::get('scale/{scale_id}/result/{user_id}', [ScaleController::class, 'show_results_individual'])->name('show_scale_results');

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
})->name('upload_scale');
Route::post('upload/scale/submit', [ScaleUploadController::class, 'process_scale_upload']);

