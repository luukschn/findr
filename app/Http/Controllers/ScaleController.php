<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Scale;
use App\Models\ScaleResult;
use Illuminate\Support\Facades\Auth;

class ScaleController extends Controller
{
    public function process_scale_results(Request $request) {
        /*
        internal-name-i
        */

        $scaleId = substr($request->url(), -1);
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

        //ScaleResult table processing
        if (ScaleResult::where('userId', Auth::id())->exists()) {
            $scaleResult = ScaleResult::where('userId', Auth::id())->first();
            $scaleResult->update(['score', $result]);
        } else {
            ScaleResult::insert(['score', $result]);
        }

        $scaleId = $scaleResult->scaleId;
        

        //scales table processing
        if (Scale::where('scaleId', $scaleId)->where('userId', Auth::id())->exists()) {
            $scale = Scale::where('scaleId', $scaleId)->where('userId', Auth::id())->first();
            $completedCount = $scale->update['completedCount'] += 1;

            //figure out how to update running average based on one additional variable.
            //also have to take in to account that the first input will be null / 0
        } else {
            //finish else clause
        }
        

    }
}
