<?php

namespace App\Http\Controllers;

use App\Models\Scale;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ScaleResult;

class MatchingController extends Controller
{
    public function match_individual() {
        /*
        Dependent on:
        - people have to have taken same scale
        - results within X sds of each other

        temporary implementation - so make it simple
        
        get verification after x time to see how well people matched -> use this for AI
        */

        //what would be an effective search. implementation will probably not scale ideally

        $user_id = Auth::id();

        $completed_scales = ScaleResult::where('user_id', $user_id)->get();

        
        //will i match on one singular scale result? or multiple? maybe return array with best matches and tell how well you match
        $matching_users = array();
        foreach($completed_scales as $scale_result) {
            $scale = Scale::where('scale_id', $scale_result->scale_id);
            $scale_SD = $scale->referenceSD;

            $current_scale_score = $scale_result->score;

            $bound = $scale_SD * 0.5;

            //cycle trough all results for a certain scale
            //match if results are within .5 SD of the respective score
            $all_scores = ScaleResult::all();

            foreach($all_scores as $individual_score) {
                if ($individual_score->user_id != Auth::id() && $individual_score->user_id != null) {
                    $other_user_score = $individual_score->score;
                    if ($other_user_score > ($current_scale_score - $bound) && $other_user_score < ($current_scale_score + $bound)) {
                        array_push($matching_users, [
                            'scale_id' => $scale_result->scale_id,
                            'foreign_user_id' => $individual_score->user_id,
                        ]);
                    }
                }
            }
        }

        if (count($matching_users) == 0) {
            return view('finder.no_match');
        } else {
            //TODO sort per user

            $data = array();

            foreach ($matching_users as $matched_user) {
                $user = User::where('user_id', $matched_user->foreign_user_id)->first();
                $person_name = $user->name;

                $scale = Scale::where('scale_id', $matched_user->scale_id)->first();
                $scale_name = $scale->officialName;

                array_push($data, [
                    'person_name' => $person_name,
                    'scale_name' => $scale_name
                ]);
            }

            return view('finder.match_page')->with('matched_users', $data);
        }
    }
}
