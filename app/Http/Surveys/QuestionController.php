<?php

namespace DDD\Http\Surveys;

use Illuminate\Http\Request;
use DDD\App\Controllers\Controller;

// Domains
use DDD\Domain\Surveys\Survey;
use DDD\Domain\Surveys\Question;

class QuestionController extends Controller
{
    // public function store(Survey $survey, PageStoreRequest $request)
    public function store(Survey $survey, Request $request)
    {
        $question = $survey->questions()->create(
            // $request->validated()
            $request->all()
        );

        return response()->json($question);
    }

    public function show(Survey $survey, Question $question)
    {
        $question = $question->load('options', 'options.answers');

        return response()->json($question);
    }

    public function destroy(Survey $survey, Question $question)
    {
        $question->delete();

        return response()->json($question);
    }
}
