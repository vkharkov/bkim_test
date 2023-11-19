<?php

namespace App\Models\Surveys;

use Illuminate\Support\Str;

class LloydsSurvey extends \App\Models\Survey
{


    public function getNumber() : string
    {
        return 'L_' . Str::orderedUuid();
    }

}
