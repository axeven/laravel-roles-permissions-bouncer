<?php

namespace App\Http\Controllers;

use App\Question;
use App\Section;
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
        return view('survey.add', compact(
            'sectionId', 'sections', 'question', 'hide_login_menu', 'nextSectionId', 'prevSectionId'
        ));
    }

    public function record(Request $request){
        if (! Gate::allows('survey_add')) {
            return response()->json(['redirect' => route('home')]);
        }

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
