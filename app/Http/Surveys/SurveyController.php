<?php

namespace DDD\Http\Surveys;

use Illuminate\Http\Request;
use DDD\App\Controllers\Controller;

// Domains
use DDD\Domain\Surveys\Survey;

class SurveyController extends Controller
{
    public function index()
    {
        $surveys = Survey::all();
        return response()->json($surveys);
    }

    // public function store(Survey $survey, PageStoreRequest $request)
    public function store(Request $request)
    {
        $survey = Survey::create(
            // $request->validated()
            $request->all()
        );

        return response()->json($survey);
    }

    public function show(Survey $survey)
    {
        $survey = $survey->load('questions');

        return response()->json($survey);
    }

    public function destroy(Survey $survey)
    {
        $survey->delete();

        return response()->json($survey);
    }
}
