<?php

namespace DDD\Domain\Surveys;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $table = 'survey_answers';

    protected $guarded = [
        'id',
    ];

    // public function submission()
    // {
    //     return $this->belongsTo('DDD\Domain\Surveys\Submissions\Submission', 'submission_id');
    // }
    //
    // public function survey()
    // {
    //     return $this->belongsTo('DDD\Domain\Surveys\Survey', 'survey_id');
    // }
    //
    // public function question()
    // {
    //     return $this->belongsTo('DDD\Domain\Surveys\Questions\Question', 'question_id');
    // }
    //
    // public function option()
    // {
    //     return $this->belongsTo('DDD\Domain\Surveys\Questions\QuestionOption', 'option_id');
    // }
}
