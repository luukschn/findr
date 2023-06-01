<?php

namespace Database\Seeders;

use App\Models\Scale;
use App\Models\ScaleQuestion;
use App\Models\ExtendedUserInfo;
use App\Models\ScaleResult;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //create admin user
        User::insert([
            'name' => 'luuk',
            'email' => 'q@q.com',
            'password' => Hash::make('luuk'),
            'is_admin' => 1
        ]);

        User::factory()
            ->count(20)
            ->has(ExtendedUserInfo::factory())
            ->create();

        $scale_id = Scale::insertGetId([
            "internalName" => "loneliness-scale",
            "officialname" => "UCLA Loneliness Scale",
            "reference" => "Russell, D. W. “The UCLA Loneliness Scale (Version 3): Reliability, validity and factorial structure,” Journal of
            Personality Assessment, 1996, 66, 20–40. Copyright 1996 by Taylor & Francis. All rights reserved.",
            "explanation" => "The following statements describe how people sometimes feel. For each statement, please indicate how often you feel the way described by selecting
            number which seems most apt.",
            "options" => "never, rarely, sometimes, always",
            "referenceMean" => 40,
            "referenceSD" => 9.5
        ]);


        $questions = [
            [
                "question_text" => "How often do you feel that you are “in tune” with the people around you?",
                "format" => "r"
            ],
            [
                "question_text" => "How often do you feel that you lack companionship?",
                "format" => "n"
            ],
            [
                "question_text" => "How often do you feel that there is no one you can turn to?",
                "format" => "n"
            ],
            [
                "question_text" => "How often do you feel alone?",
                "format" => "n"
            ],
            [
                "question_text" => "How often do you feel part of a group of friends?",
                "format" => "r"
            ],
            [
                "question_text" => "How often do you feel that you have a lot in common with the people around you?",
                "format" => "r"
            ],
            [
                "question_text" => "How often do you feel that you are no longer close to anyone?",
                "format" => "n"
            ],
            [
                "question_text" => "How often do you feel that your interests and ideas are not shared by those around you?",
                "format" => "n"
            ],
            [
                "question_text" => "How often do you feel outgoing and friendly?",
                "format" => "r"
            ],
            [
                "question_text" => "How often do you feel close to people?",
                "format" => "r"
            ],
            [
                "question_text" => "How often do you feel left out?",
                "format" => "n"
            ],
            [
                "question_text" => "How often do you feel that your relationships with others are not meaningful?",
                "format" => "n"
            ],
            [
                "question_text" => "How often do you feel that no one really knows you well?",
                "format" => "n"
            ],
            [
                "question_text" => "How often do you feel isolated from others?",
                "format" => "n"
            ],
            [
                "question_text" => "How often do you feel you can find companionship when you want it?",
                "format" => "r"
            ],
            [
                "question_text" => "How often do you feel that there are people who really understand you?",
                "format" => "r"
            ],
            [
                "question_text" => "How often do you feel shy?",
                "format" => "n"
            ],
            [
                "question_text" => "How often do you feel that people are around you but not with you?",
                "format" => "n"
            ],
            [
                "question_text" => "How often do you feel that there are people you can talk to?",
                "format" => "r"
            ],
            [
                "question_text" => "How often do you feel that there are people you can turn to?",
                "format" => "r"
            ]
        ];

        foreach ($questions as $question) {

            ScaleQuestion::insert([
                'scale_id' => $scale_id,
                'question_text' => $question['question_text'],
                'format' => $question['format']
            ]);
        }



        Scale::factory()
            ->count(3)
            ->has(ScaleQuestion::factory()->count(random_int(5, 20)))
            ->has(ScaleResult::factory()->count(random_int(2, 20)))
            ->create();
    }
}
