<?php

namespace App\Services;

use App\Enums\SurveyState;
use App\Http\Requests\SurveyRequest;
use App\Models\Client;
use App\Models\Survey;
use App\Models\User;
use App\Repositories\ClientRepository;
use App\Repositories\UserRepository;
use App\Traits\CanSetUser;
use Carbon\Carbon;

class ClientService
{

    use CanSetUser;

    public function __construct(private ClientRepository $clientRepository, private UserRepository $userRepository)
    {}

    public function createClient(User $user) : Client
    {

        if ( $user->client != null )
            return $user->client;

        $client = new Client();
        $client->fill([
            'user_id' => $user->id,
            'phone' => $user->phone,
            'email' => $user->email,
        ]);
        $client->save();

        return $client;

    }

    public function createSurvey(SurveyRequest $surveyRequest)
    {

        if ( $this->user->client === null )
            $client = $this->createClient($this->userRepository->getAuthorizedUser());
        else
            $client = $this->user->client;

        $client->fill([
            'first_name' => $surveyRequest->get('first_name'),
            'middle_name' => $surveyRequest->get('middle_name'),
            'last_name' => $surveyRequest->get('last_name'),
            'dob' => Carbon::parse($surveyRequest->get('dob'))->format('Y-m-d 00:00:00'),
            'address' => $surveyRequest->get('address')
        ]);
        $client->save();

        $survey = new Survey();
        $survey->fill([
            'user_id' => $this->user->id,
            'client_id' => $client->id,
            'client_text' => $surveyRequest->get('comment'),
            'title' => 'Default survey title'
        ]);
        $survey->save();

        return $survey;

    }

    public function acceptSurvey(Survey $survey)
    {
        return $this->setSurveyState($survey, SurveyState::Accepted);
    }

    public function declineSurvey(Survey $survey)
    {
        return $this->setSurveyState($survey, SurveyState::Declined);
    }

    private function setSurveyState(Survey $survey, SurveyState $state)
    {
        $survey->update(['state' => $state]);
        return $survey;

    }

}
