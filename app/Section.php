<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $table = 'section';
    protected $fillable = ['name', 'order'];

    public function questions()
    {
        return $this->hasMany('App\Question');
    }
}
