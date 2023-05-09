<?php

namespace App\Http\Controllers;

use App\Models\ScaleInformation;
use App\Models\ScaleQuestion;
use Illuminate\Http\Request;

class ScaleUploadController extends Controller
{
    public function process_scale_upload (Request $request) {
        
        //TODO add validator
        $questions = $request->input('questions');

        //'scales' table has the original ID. should probably be the other way around -> redo database structure ideally

        $scaleInformationData = [
            "internalName" => $request->internalName,
            "officialName" => $request->officialName,
            "reference" => $request->reference,
            "explanation" => $request->explanation,
            "options" => $request->options,
            "referenceMean" => $request->referenceMean,
            "referenceSD" => $request->referenceSD
        ];
        ScaleInformation::insert($scaleInformationData);

        $i = 0;
        foreach($request->input('questions') as $question) {
            ScaleQuestion::insert([
                "question_text" => $question,
                "format" => $request->input('format')[$i]
            ]);

            $i++;
        }

        return view('finder.finder_home');
    }
}
