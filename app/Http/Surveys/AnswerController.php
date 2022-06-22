<?php

namespace DDD\Http\Surveys;

use Illuminate\Http\Request;
use DDD\App\Controllers\Controller;

// Domains
use DDD\Domain\Surveys\Survey;
use DDD\Domain\Surveys\Question;
use DDD\Domain\Surveys\Option;
use DDD\Domain\Surveys\Participant;

class AnswerController extends Controller
{
    // public function store(Survey $survey, PageStoreRequest $request)
    public function store(Survey $survey, Question $question, Option $option, Request $request)
    {
        $answer = $option->answers()->create(
            // $request->validated()
            $request->all()
        );

        return response()->json($answer);
    }
}
