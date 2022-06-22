<?php

namespace DDD\Http\Surveys;

use Illuminate\Http\Request;
use DDD\App\Controllers\Controller;

// Domains
use DDD\Domain\Surveys\Survey;
use DDD\Domain\Surveys\Question;
use DDD\Domain\Surveys\Option;

class OptionController extends Controller
{
    // public function store(Survey $survey, PageStoreRequest $request)
    public function store(Survey $survey, Question $question, Request $request)
    {
        $option = $question->options()->create(
            // $request->validated()
            $request->all()
        );

        return response()->json($option);
    }

    public function destroy(Survey $survey, Question $question, Option $option)
    {
        $option->delete();

        return response()->json($option);
    }
}
