@php
      $scaleInfo = [
            "internalName" => "loneliness-scale",
            "officialName" => "UCLA Loneliness Scale",
            "reference" => "Russell, D. W. “The UCLA Loneliness Scale (Version 3): Reliability, validity and factorial structure,” Journal of
    Personality Assessment, 1996, 66, 20–40. Copyright 1996 by Taylor & Francis. All rights reserved.",
            "explanation" => "The following statements describe how people sometimes feel. For each statement, please indicate how often you feel the way described by selecting
            number which seems most apt.",
            "option-count" => 4,
            "options" => [
                "never", 
                "rarely",
                "sometimes", 
                "always"
            ],
            "questions" => [
                1 => [
                    "q" => "How often do you feel that you are “in tune” with the people around you?",
                    "format" => "r"
                ],
                2 => [
                    "q" => "How often do you feel that you lack companionship?",
                    "format" => "n"
                ],
                3 => [
                    "q" => "How often do you feel that there is no one you can turn to?",
                    "format" => "n"
                ],
                4 => [
                    "q" => "How often do you feel alone?",
                    "format" => "n"
                ],
                5 => [
                    "q" => "How often do you feel part of a group of friends?",
                    "format" => "r"
                ],
                6 => [
                    "q" => "How often do you feel that you have a lot in common with the people around you?",
                    "format" => "r"
                ],
                7 => [
                    "q" => "How often do you feel that you are no longer close to anyone?",
                    "format" => "n"
                ],
                8 => [
                    "q" => "How often do you feel that your interests and ideas are not shared by those around you?",
                    "format" => "n"
                ],
                9 => [
                    "q" => "How often do you feel outgoing and friendly?",
                    "format" => "r"
                ],
                10 => [
                    "q" => "How often do you feel close to people?",
                    "format" => "r"
                ],
                11 => [
                    "q" => "How often do you feel left out?",
                    "format" => "n"
                ],
                12 => [
                    "q" => "How often do you feel that your relationships with others are not meaningful?",
                    "format" => "n"
                ],
                13 => [
                    "q" => "How often do you feel that no one really knows you well?",
                    "format" => "n"
                ],
                14 => [
                    "q" => "How often do you feel isolated from others?",
                    "format" => "n"
                ],
                15 => [
                    "q" => "How often do you feel you can find companionship when you want it?",
                    "format" => "r"
                ],
                16 => [
                    "q" => "How often do you feel that there are people who really understand you?",
                    "format" => "r"
                ],
                17 => [
                    "q" => "How often do you feel shy?",
                    "format" => "n"
                ],
                18 => [
                    "q" => "How often do you feel that people are around you but not with you?",
                    "format" => "n"
                ],
                19 => [
                    "q" => "How often do you feel that there are people you can talk to?",
                    "format" => "r"
                ],
                20 => [
                    "q" => "How often do you feel that there are people you can turn to?",
                    "format" => "r"
                ]
            ],
            "scoreReference" => [
                "average" => 40,
                "SD" => 9.5
            ]
        ];
@endphp


@extends('scales.scale_template', [ 'scale' => $scaleInfo])

@section('title', 'Loneliness Scale')