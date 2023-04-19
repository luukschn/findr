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

        $scaleId = $request->scaleId;
        $internal_name = $request->internalName;
        $question_count = $request->questionCount; 
        $option_count = $request->optionCount;

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
        if (Scale::where('scaleId', $scaleId)->exists()) {
            //TODO separate functions

            /* mean */
            // avg also not working correctly. seems to be cumulative results
            //TODO only last score for a given user?
            $scale = Scale::where('scaleId', $scaleId)->first();
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
                'completedCount' => 1
            ]);
        }


        //ScaleResult table processing
        if (ScaleResult::where('userId', Auth::id())->where('scaleId', $scaleId)->exists()) {
            $scaleResult = ScaleResult::where('userId', Auth::id())->where('scaleId', $scaleId)->first();
            $scaleResult->update(['score' => $result]);
            $scaleResult->save();
        } else {
            ScaleResult::insert([
                'score' => $result,
                'userId' => Auth::id(),
                'scaleId' => $scaleId,
                'created_at' => new DateTime()
            ]);
        }
        
        //TODO refer to results page
        return redirect('/about');
    }
}
