<?php

namespace App\Http\Controllers;

use Auth;
use App\Answer;
use App\Question;
use App\Section;
use App\Survey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class SurveyController extends Controller
{
    public function __construct(){
        view()->share(['tab_selected' => 'survey']);
    }

    public function add(Request $request){
        if (! Gate::allows('survey_add')) {
            return redirect()->route('home');
        }
        $section = [];
        if ($request->has('section_id')){
            $section = Section::find($request->input('section_id'));   
        }
        if (!$request->has('section_id') || !$section){
            $section = Section::orderBy('order', 'asc')->first();
        }
        $sectionId = $section->id;
        $sections = Section::orderBy('order', 'asc')->get();
        $question = Question::where('section_id', $section->id)->orderBy('order', 'asc')->get();
        $hide_login_menu = true;
        $temp = $this->getNextPrevSectionId($sections, $sectionId);
        $nextSectionId = $temp['next'];
        $prevSectionId = $temp['prev'];
        $surveys = Auth::user()->surveys()->get();
        return view('survey.add', compact(
            'sectionId', 'sections', 'question', 'hide_login_menu', 'nextSectionId', 'prevSectionId', 'surveys'
        ));
    }

    public function record(Request $request) {
        if (! Gate::allows('survey_add')) {
            return response()->json(['redirect' => route('home')]);
        }
        $survey = $request->input('surveys');
        foreach( $survey as $s ) {
            $q = Question::find($s['question_id']);
            if ($q->type == 'select-multiple'){
                // delete unchecked answers first
                $keep = [];
                if (array_key_exists('answers', $s)){
                    foreach($s['answers'] as $a){
                        $surv = '';
                        if (array_key_exists('id', $a)){
                            array_push($keep, $a['id']);
                        }
                    }
                }
                Survey::whereNotIn('id', $keep)
                    ->where('user_id', Auth::user()->id)
                    ->where('question_id', $q->id)
                    ->delete();
                // add new checked anwers
                if (array_key_exists('answers', $s)){
                    foreach($s['answers'] as $a){
                        $surv = '';
                        if (!array_key_exists('id', $a)){
                            $surv = new Survey();
                            $surv->user()->associate(
                                Auth::user()
                            );
                            $surv->question()->associate($q);
                            if (array_key_exists('valtext', $a)){
                                $surv->valtext = $a['valtext'];
                            }else{
                                $surv->answer()->associate(Answer::find($a['val']));
                            }
                            $surv->save();
                        }
                    }
                }
            }else{
                if (array_key_exists('answers', $s)){
                    foreach($s['answers'] as $a){
                        $surv = '';
                        if (array_key_exists('id', $a)){
                            $surv = Survey::find($a['id']);
                            
                        }else{
                            $surv = new Survey();
                            $surv->user()->associate(
                                Auth::user()
                            );
                            $surv->question()->associate($q);
                        }
                        if (array_key_exists('valtext', $a)){
                            $surv->valtext = $a['valtext'];
                        }else{
                            $surv->answer()->associate(Answer::find($a['val']));
                        }
                        $surv->save();
                    }
                }
            }
        }
        $sectionId = 1;
        if ($request->has('section_id')){
            $sectionId = $request->input('section_id');
        }
        return response()->json(['redirect' => route('survey.add', ['section_id' => $sectionId])]);
    }

    private function getNextPrevSectionId($orderedSections, $sectionId){
        $prev = -1;
        $next = -1;
        $breakNext = false;
        foreach($orderedSections as $s){
            if ($breakNext){
                $next = $s->id;
                break;
            }
            if ($s->id == $sectionId){
                $breakNext = true;
            }
            $prev = $s->id;
        }
        return ['prev' => $prev, 'next' => $next];
    }
}
