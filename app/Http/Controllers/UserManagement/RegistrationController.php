<?php

namespace App\Http\Controllers\UserManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

use App\Models\User;
use Nette\Utils\DateTime;
use App\Http\Controllers\UserManagement\LoginController;
use App\Http\Requests\UserRegistrationRequest;

class RegistrationController extends LoginController
{
    public function submitRegistration(UserRegistrationRequest $request) {
        //would be nicer to have auth check in the routes file I guess?
        if (Auth::check()) {
            return redirect('/');
        } else {

            //confused as to how this works. Need to look in to it
            $validated_credentials = $request->validated();

            User::insert([
                'name' => $validated_credentials['name'],
                'email' => $validated_credentials['email'],
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
                'password' => Hash::make($validated_credentials['password'])
            ]);
        }

        return $this->login($request);
    }

}
