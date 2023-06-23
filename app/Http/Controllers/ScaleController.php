<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Scale;
use App\Models\ScaleResult;
use Illuminate\Support\Facades\Auth;
use Nette\Utils\DateTime;
use App\Helpers\ScaleHelpers;


class ScaleController extends Controller
{
    public function process_scale_results(Request $request) {
        /*
        internal-name-i
        */

        $scale_id = $request->scale_id;
        $officalName = $request->officialName;

        $result = ScaleHelpers::calculate_scale_result($request);

        //scales table processing
        if (Scale::where('scale_id', $scale_id)->exists()) {
            //TODO separate functions

            /* mean */
            // avg also not working correctly. seems to be cumulative results
            //TODO only last score for a given user?
            $scale = Scale::where('scale_id', $scale_id)->first();
            $old_completed_count = $scale['completedCount'];

            //not sure if this breaks algorithm at low instances
            if ($old_completed_count == 0) {
                $old_completed_count = 1;
                $new_completed_count = 3;
            };

            $new_completed_count = $old_completed_count + 1;
            $scale->update(['completedCount' => $new_completed_count]);

            $old_avg = $scale['resultsAvg'];
            $new_avg = ((($old_avg * $old_completed_count) + $result) / $new_completed_count);
            $new_avg = ((($old_avg * $old_completed_count) + $result) / $new_completed_count);


            /* SD */
            //TODO verify if this algorithm functions as intended - https://math.stackexchange.com/a/775678
            //seems to return incorrect value. Need to find a different algorithm (?)
            $old_sd = $scale['resultsSD'];
            $old_variance = $old_sd ** 2;
            $new_variance = (($new_completed_count - 2) * $old_variance + ($result - $new_avg)*($result - $old_avg)) / $old_completed_count;
            $new_sd = sqrt($new_variance);
            

            $scale->update([
                'resultsAvg' => $new_avg,
                'resultsSD' => $new_sd
            ]);
            $scale->save();

        } else {
            //n = 1
            //TODO also add the input of the source avg and sd from here, so I can just add that to my template for scales
            Scale::insert([
                'resultsSD' => 1,
                'resultsAvg' => $result,
                'completedCount' => 1,
                'scaleName' => $officalName
            ]);
        }


        //ScaleResult table processing
        if (ScaleResult::where('user_id', Auth::id())->where('scale_id', $scale_id)->exists()) {
            $scaleResult = ScaleResult::where('user_id', Auth::id())->where('scale_id', $scale_id)->first();
            $scaleResult->update(['score' => $result]);
            $scaleResult->save();
        } else {
            ScaleResult::insert([
                'score' => $result,
                'user_id' => Auth::id(),
                'scale_id' => $scale_id,
                'created_at' => new DateTime()
            ]);
        }
        
        return $this->show_results_individual($scale_id, Auth::id());
    }

    public function show_results_individual($scale_id, $user_id, $no_auth_score = 0) {
        if (Auth::check() && (Auth::id() == $user_id)) {

            $scaleResult = ScaleResult::where('user_id', $user_id)->where('scale_id', $scale_id)->first();
            $scale = Scale::where('scale_id', $scale_id)->first();

            if ($scaleResult != null ) { //ensure that empty results == null
                $score = $scaleResult->score;
                $scaleAvg = $scale->referenceMean;
                $scaleSD = $scale->referenceSD;

                //calculate score percentile
                $z_score = ($score - $scaleAvg) / $scaleSD;
                $percentile = (ScaleHelpers::cdf($z_score)) * 100;

                $results = [
                    'score' => $score,
                    'average' => $scaleAvg, 
                    'sd' => $scaleSD,
                    'percentile' => $percentile
                ];

                return view('scales.scale_results')->with('results', $results);
            } else {
                return view('scale/' . $scale_id);
            }

        } else {
            if ($user_id == -1) {
                
                $score = $no_auth_score;
                $scale = Scale::where('scale_id', $scale_id)->first();

                if ($scale != null) {
                    $scaleAvg = $scale->referenceMean;
                    $scaleSD = $scale->referenceSD;
    
                    //calculate score percentile
                    $z_score = ($score - $scaleAvg) / $scaleSD;
                    $percentile = (ScaleHelpers::cdf($z_score)) * 100;
    
                    $results = [
                        'score' => $score,
                        'average' => $scaleAvg, 
                        'sd' => $scaleSD,
                        'percentile' => $percentile
                    ];
                }

                return view('scales.scale_results')->with('results', $results);

            } else {
                //TODO alternatively redirect back with error popup that you cannot access this page
                // return view('no_access_page');
                return view('homepage');
            } 
            
        }
    }

    public function process_scale_results_no_auth(Request $request) {

        $scale_id = $request->scale_id;

        $result = ScaleHelpers::calculate_scale_result($request);

        //using nonexistant userId to access function. Maybe not the best fix.
        $this->show_results_individual($scale_id, -1, $result);
    }
    

}
