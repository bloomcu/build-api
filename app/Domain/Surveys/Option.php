<?php

namespace DDD\Domain\Surveys;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;

    protected $table = 'survey_options';

    protected $guarded = [
        'id',
    ];

    public function answers()
    {
        return $this->hasMany('DDD\Domain\Surveys\Answer', 'option_id');
    }
}
