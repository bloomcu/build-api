<?php

namespace DDD\Http\Surveys;

use Illuminate\Http\Request;
use DDD\App\Controllers\Controller;

// Domains
use DDD\Domain\Surveys\Survey;
use DDD\Domain\Surveys\Participant;

class ParticipantController extends Controller
{
    public function index(Survey $survey)
    {
        return response()->json($survey->participants);
    }

    // public function store(Survey $survey, PageStoreRequest $request)
    public function store(Survey $survey, Request $request)
    {
        $question = $survey->participants()->create(
            // $request->validated()
            $request->all()
        );

        return response()->json($question);
    }

    public function destroy(Survey $survey, Participant $participant)
    {
        $participant->delete();

        return response()->json($participant);
    }
}
