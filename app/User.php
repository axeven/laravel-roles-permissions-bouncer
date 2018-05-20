<?php
namespace App;

use App\Question;
use App\Report;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Silber\Bouncer\Database\HasRolesAndAbilities;
use Hash;

/**
 * Class User
 *
 * @package App
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $remember_token
*/
class User extends Authenticatable
{
    use Notifiable;
    use HasRolesAndAbilities;

    protected $fillable = ['name', 'email', 'password', 'remember_token', 'has_company'];
    private $section = [
        2 => 'hr',
        3 => 'finance',
        4 => 'sales',
        5 => 'marketing',
    ];
    
    /**
     * Hash password
     * @param $input
     */
    public function setPasswordAttribute($input)
    {
        if ($input)
            $this->attributes['password'] = app('hash')->needsRehash($input) ? Hash::make($input) : $input;
    }
    
    
    public function role()
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }
    
    public function surveys(){
        return $this->hasMany('App\Survey');
    }

    public function canViewReport(){
        $qid = Question::where('section_id', '!=', 1)->pluck('id');
        $sid = Survey::where('user_id', $this->id)
            ->whereIn('question_id', $qid)
            ->distinct('question_id')
            ->pluck('question_id')
            ->count();
        return $sid == $qid->count();
    }

    public function getScores(){
        $qid = Question::where('section_id', '!=', 1)->pluck('id');
        $surveys = $this->surveys()->whereIn('question_id', $qid)->get();
        $scores = [];
        foreach($surveys as $s){
            $section = $s->question->section->id;
            $question = $s->question->id;
            if (!array_key_exists($section, $scores)){
                $scores[$section] = [];
            }
            if (!array_key_exists($question, $scores[$section])){
                $scores[$section][$question] = 0;
            }
            $scores[$section][$question] = max($scores[$section][$question], $s->answer->score);
        }
        return $scores;
    }

    public function getSumScores(){
        $scores = $this->getScores();
        $sumScores = [];
        foreach ($scores as $sid => $arr){
            $sumScores[$sid] = 0;
            foreach($arr as $aid => $score){
                $sumScores[$sid] += $score;
            }
        }
        return $sumScores;
    }

    public function report(){
        return $this->hasOne('App\Report');
    }

    public function saveReport(){
        $sum = $this->getSumScores();
        if($this->report){
            foreach ($sum as $k => $v){
                $key = $this->section[$k];
                $this->report->$key = $v;
            }
            $this->report->save();
            return;
            
        }
        $data = [];
        foreach ($sum as $k => $v){
            $data[$this->section[$k]]= $v;
        }
        $data['user_id'] = $this->id;
        Report::create($data);
    }

}
