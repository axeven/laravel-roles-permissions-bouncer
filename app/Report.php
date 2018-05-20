<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $table = 'report';
    protected $fillable = ['hr','finance', 'marketing', 'sales', 'user_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
