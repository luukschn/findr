<?php

namespace App\Http\Controllers;

use App\Http\Requests\ScaleUploadRequest;
use App\Models\Scale;
use App\Models\ScaleQuestion;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

class ScaleUploadController extends Controller
{
    public function process_scale_upload(ScaleUploadRequest $request) {
    // public function process_scale_upload(Request $request) {
        
        //TODO add validator -> not sure if I can do that via AJAX
        $validator = $request->validated();
        if ($validator->fails()) {
            // return redirect()->back()->withErrors($validator)->withInput();
            return new JsonResponse(['errors' => $validator->errors()], 422);
        }
        

        // $scaleInformationData = [
        //     "internalName" => $_POST['internalName'],
        //     "officialName" => $_POST['officialName'],
        //     "reference" => $_POST['reference'],
        //     "explanation" => $_POST['explanation'],
        //     "options" => $_POST['options'],
        //     "referenceMean" => $_POST['referenceMean'],
        //     "referenceSD" => $_POST['referenceSD']
        // ];
        $scaleInformationData = [
            "internalName" => $request->input('internalName'),
            "officialName" => $request->input('officialName'),
            "reference" => $request->input('reference'),
            "explanation" => $request->input('explanation'),
            "options" => $request->input('options'),
            "referenceMean" => $request->input('referenceMean'),
            "referenceSD" => $request->input('referenceSD')
        ];
        $scale_id = Scale::insertGetId($scaleInformationData);
        
        // $questions = $_POST['questions'];
        // $format = $_POST['format'];
        $questions = $request->input('questions');
        $format = $request->input('format');
        foreach(array_combine($questions, $format) as $question => $format) {
            ScaleQuestion::insert([
                "question_text" => $question,
                "format" => $format,
                "scale_id" => $scale_id
            ]);
        };

        // return response()->json(['success' => true]);
        return new JsonResponse(['success' => true]);
    }
}
