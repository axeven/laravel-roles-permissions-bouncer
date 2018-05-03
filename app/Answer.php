<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $table = 'answer';
    protected $fillable = ['sentence', 'score', 'order'];

    public function question()
    {
        return $this->belongsTo('App\Question');
    }
}
