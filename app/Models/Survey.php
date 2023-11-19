<?php

namespace App\Models;

use App\Enums\SurveyState;
use App\Interfaces\SurveyInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Survey extends Model implements SurveyInterface, HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [

        'user_id',
        'client_id',

        'number',
        'state',

        'title',
        'client_text',

        'reviewed_by',
        'reviewed_at',
        'reviewed_text',

    ];

    protected static function booted()
    {
        static::creating(function ($survey) {
            $survey->state = SurveyState::Draft;
            $survey->number = $survey->getNumber();
        });

    }

    public function getNumber() : string
    {
        do {
            $number = 'default_' . Carbon::now()->format('Y-m-d-H-i-s' . rand());
        } while ( Survey::query()->where('number','=',$number)->exists());

        return $number;
    }

}
