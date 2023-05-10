<?php

namespace App\Http\Controllers;

use App\Models\Scale;
use App\Models\ScaleQuestion;
use Illuminate\Http\Request;

class ScaleUploadController extends Controller
{
    public function process_scale_upload(Request $request) {
        
        //TODO add validator

        $scaleInformationData = [
            "internalName" => $request->internalName,
            "officialName" => $request->officialName,
            "reference" => $request->reference,
            "explanation" => $request->explanation,
            "options" => $request->options,
            "referenceMean" => $request->referenceMean,
            "referenceSD" => $request->referenceSD
        ];
        $scale = Scale::insert($scaleInformationData);
        
        

        // $i = 0;

        $questions_with_format = array();
        $qs = $request->input('questions');
        $f = $request->input('format');

        info($qs);
        info($f);

        // for ($i = 0; $i <= count($request->input('questions'); $i++)) {
        //     info("Q: " . )
        // };

        // foreach($request->input('questions') as $question) {
        //     ScaleQuestion::insert([
        //         "question_text" => $question,
        //         "format" => $request->input('format')[$i]
        //     ]);

        //     $i++;
        // }

        // return view('finder.finder_home');
    }
}
