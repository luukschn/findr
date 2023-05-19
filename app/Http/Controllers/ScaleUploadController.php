<?php

namespace App\Http\Controllers;

use App\Models\Scale;
use App\Models\ScaleQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

class ScaleUploadController extends Controller
{
    public function process_scale_upload() {
    // public function process_scale_upload(Request $request) {
        
        //TODO add validator -> not sure if I can do that via AJAX
        

        $scaleInformationData = [
            "internalName" => $_POST['internalName'],
            "officialName" => $_POST['officialName'],
            "reference" => $_POST['reference'],
            "explanation" => $_POST['explanation'],
            "options" => $_POST['options'],
            "referenceMean" => $_POST['referenceMean'],
            "referenceSD" => $_POST['referenceSD']
        ];
        $scaleId = Scale::insertGetId($scaleInformationData);
        
        $questions = $_POST['questions'];
        $format = $_POST['format'];
        foreach(array_combine($questions, $format) as $question => $format) {
            ScaleQuestion::insert([
                "question_text" => $question,
                "format" => $format,
                "scaleId" => $scaleId
            ]);
        };


    }
}
