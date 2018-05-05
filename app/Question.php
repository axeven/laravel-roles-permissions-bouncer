<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'question';
    protected $fillable = ['label', 'sentence', 'type', 'order'];


    public function answers()
    {
        return $this->hasMany('App\Answer');
    }

    public function section()
    {
        return $this->belongsTo('App\Section');
    }
}
