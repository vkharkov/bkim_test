<?php

namespace App\Enums;

enum SurveyState: int
{

    case Draft = 0;
    case Submitted = 1;
    case Reviewed = 2;
    case Accepted = 3;
    case Declined = 4;

    /** Utility */
    public function text(): string
    {
        return match($this) {
            SurveyState::Draft => 'draft',
            SurveyState::Submitted => 'submitted',
            SurveyState::Reviewed => 'reviewed',
            SurveyState::Accepted => 'accepted',
            SurveyState::Declined => 'declined',
        };
    }

}
