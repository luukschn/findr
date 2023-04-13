<?php

namespace App\Http\Controllers\UserManagement;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\extendedUserInfo;
use Illuminate\Support\Facades\Hash;
use Nette\Utils\DateTime;

class ProfileController extends Controller
{
    public function get_profile($userId) {
        if (Auth::check() && (Auth::id() == $userId)) {
            $extended_user_info = extendedUserInfo::where('userId', $userId)->first();

            if ($extended_user_info) {
                $user_info = [
                    "dateOfBirth" => $extended_user_info->dateOfBirth,
                    "country" => $extended_user_info->country,
                    "location" => $extended_user_info->location,
                    "jobTitle" => $extended_user_info->jobTitle,
                    "educationLevel" => $extended_user_info->educationLevel,
                    "gender" => $extended_user_info->gender,
                    "bio" => $extended_user_info->bio
                ];
            } else {
                $user_info = [
                    "dateOfBirth" => '',
                    "country" => '',
                    "location" => '',
                    "jobTitle" => '',
                    "educationLevel" => '',
                    "gender" => '',
                    "bio" => ''
                ];
            };

            

            return view('profile.profile_page')->with('userInfo', $user_info);
        }
    }

    public function update_profile(ProfileUpdateRequest $request) {
        if (Auth::check()) {

            //inserting data even if it inst changed. maybe have to do a check for that? this is way simpler though.
            $user_info = $request->validated();

            $user = User::where('id', Auth::id())->first();
            $user->name = $user_info['name'];
            $user->email = $user_info['email'];
            $user->updated_at = new DateTime();
            $user->save();
            

            if (!extendedUserInfo::where('userId', Auth::id())->exists()) {
                $extended_user_info = array();

                foreach ($user_info as $key => $value) {
                    if ($user_info != null && $key != 'name' && $key != 'email') {
                        $extended_user_info[$key] = $value;
                    }
                }

                if (count($extended_user_info) != 0) {
                    $extended_user_info['userId'] = Auth::id();
                    $extended_user_info['created_at'] = new DateTime();
                    $extended_user_info['updated_at'] = new DateTime();

                    extendedUserInfo::insert($extended_user_info);
                }

            } else {
                // update everything, null where nothing is put in. Ensure database, model, and request validators can handle this.
                $extended_user_info = extendedUserInfo::where('userId', Auth::id());

                foreach ($user_info as $key => $value) {
                    if ($key != 'name' && $key != 'email') {
                        $extended_user_info->update([$key => $value]);
                    }
                }

                $extended_user_info->update(['updated_at' => new DateTime()]);

            }


            // return $this->get_profile(Auth::id());
            return redirect()->route('profile.show', ['id'=> Auth::id()]);

        } else {
            
            return redirect()->back();
        }


    }
}
