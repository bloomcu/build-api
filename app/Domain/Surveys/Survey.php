<?php

namespace DDD\Domain\Surveys;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    protected $casts = [
        'settings' => 'json'
    ];

    public function questions()
    {
        return $this->hasMany('DDD\Domain\Surveys\Question');
    }

    public function participants()
    {
        return $this->hasMany('DDD\Domain\Surveys\Participant');
    }
}
