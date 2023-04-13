<?php

namespace App\Http\Controllers\UserManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login (Request $request): RedirectResponse {
        //https://laracasts.com/discuss/channels/laravel/authattempt-why-email-or-password

        if (Auth::check()) {
            return redirect('/');

        } else {

            $login_credentials = $request->validate([
                'email' => ['required', 'email'],
                'password' => 'required'
            ]);

            // if (! Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            if (! Auth::attempt($login_credentials)) {
                // auth attempt fails
                return back()->withErrors([
                    //TODO: add more errors
                    // 'email.required' => 'Email is required!',
                    // 'password.required' => 'Password is required!'
                    'email' => 'Provided login credentials are incorrect.'
                ])->withInput();
            }

            
            $request->session()->regenerate();
                
            return redirect('/');
            
        }
        

        
    }
}
