<?php

namespace DDD\Domain\Surveys;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;

    protected $table = 'survey_participants';

    protected $guarded = [
        'id',
    ];

    public function answers()
    {
        return $this->hasMany('DDD\Domain\Surveys\Answer');
    }
}
