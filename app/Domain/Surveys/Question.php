<?php

namespace DDD\Domain\Surveys;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $table = 'survey_questions';

    protected $guarded = [
        'id',
    ];

    public function options()
    {
        return $this->hasMany('DDD\Domain\Surveys\Option');
    }
}
