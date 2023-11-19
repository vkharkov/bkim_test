<?php

namespace App\Models\Surveys;

use App\Models\Survey;
use Carbon\Carbon;

class BankOfLimassolSurvey extends \App\Models\Survey
{

    public function getNumber() : string
    {

        do {
            $number = 'BOL_' . Carbon::now()->format('Y-m-d-H-i-s' . rand());
        } while ( Survey::query()->where('number','=',$number)->exists());

        return $number;

    }

}
