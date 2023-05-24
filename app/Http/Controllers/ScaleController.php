<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Scale;
use App\Models\ScaleResult;
use Illuminate\Support\Facades\Auth;
use Nette\Utils\DateTime;

class ScaleController extends Controller
{
    public function process_scale_results(Request $request) {
        /*
        internal-name-i
        */

        $scale_id = $request->scale_id;
        $internal_name = $request->internalName;
        $question_count = $request->questionCount; 
        $option_count = $request->optionCount;
        $officalName = $request->officialName;

        $result = 0;
        for ($i=1; $i <= $question_count; $i++) {
            if ($request->input($internal_name . "-format-" . $i) == "n") {
                //format normal, options can just be added to total
                $result += (int)$request->input($internal_name . "-" . $i);
            } else {
                //format reversed, values have to be reversed

                //TODO make reversal function separate
                $result += $option_count - (int)$request->input($internal_name . "-" . $i) + 1;
            }
        }
        

        //scales table processing
        if (Scale::where('scale_id', $scale_id)->exists()) {
            //TODO separate functions

            /* mean */
            // avg also not working correctly. seems to be cumulative results
            //TODO only last score for a given user?
            $scale = Scale::where('scale_id', $scale_id)->first();
            $old_completed_count = $scale['completedCount'];
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
                'resultsSD' => 0,
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
        
        //TODO refer to results page
        return $this->show_results_individual($scale_id, Auth::id());
    }

    public function show_results_individual($scale_id, $user_id) {
        if (Auth::check()) {

            $scaleResult = ScaleResult::where('user_id', $user_id)->where('scale_id', $scale_id)->first();
            $scale = Scale::where('scale_id', $scale_id)->first();

            if ($scaleResult != null ) { //ensure that empty results == null
                $score = $scaleResult->score;
                $scaleAvg = $scale->sourceAvg; //both entries removed from scales table
                $scaleSD = $scale->sourceSD;

                //calculate score percentile
                $z_score = ($score - $scaleAvg) / $scaleSD;
                $percentile = ($this->cdf($z_score)) * 100;

                $results = [
                    'score' => $score,
                    'average' => $scaleAvg, 
                    'sd' => $scaleSD,
                    'percentile' => $percentile
                ];

                return view('scales.scale_results')->with('results', $results);
            } else {
                return redirect('scale/' . $scale_id);
            }

        } else {
            if (Auth::id() != $user_id) {
                //TODO alternatively redirect back with error popup that you cannot access this page
                return redirect('no_access_page');
            } else {
                return view('login');
            }

            
            
        }
    }


    
    private function erf($x) {
        //TODO: move to helper file somewhere

        //https://www.php.net/manual/en/function.stats-stat-percentile.php#88558
        $pi = pi();

        $a = (8 * ($pi - 3)) / (3 * $pi * (4 - $pi));
        $x2 = $x * $x;
        $ax2 = $a * $x2;

        $num = (4/$pi) + $ax2;
        $denom = 1 + $ax2;

        $inner = (-$x2) * $num/$denom;
        $erf2 = 1 - exp($inner);

        return sqrt($erf2);
    }

    private function cdf($n) {
        if ($n < 0) {
            return (1 - $this->erf($n / sqrt(2))) / 2;
        } else {
            return (1 + $this->erf($n / sqrt(2))) / 2;
        }
    }
}
