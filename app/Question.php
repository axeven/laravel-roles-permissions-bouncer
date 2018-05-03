<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'question';
    protected $fillable = ['label', 'sentence', 'choosability'];


    public function answers()
    {
        return $this->hasMany('App\Answer');
    }
}
