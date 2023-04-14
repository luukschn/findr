<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Scale;
use App\Models\ScaleResult;

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


                //ineffective reversal method. What happens if there are 7 options?
                //or scale 1-100?
                // $request->input($internal_name . "-" . $i);

                //make algorithm which can reverse the inputs based on $option-count
            }
        }

    }
}
