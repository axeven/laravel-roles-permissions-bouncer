<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Question;
use App\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Lang;
class QuestionController extends Controller
{

    private $types = [];

    public function __construct()
    {
        $this->types = [
            'text' => Lang::get('global.questions.types.text'),
            'textarea' => Lang::get('global.questions.types.textarea'),
            'select-single' => Lang::get('global.questions.types.single'),
            'select-multiple' => Lang::get('global.questions.types.multiple')
        ];
    }

    public function index(Request $request)
    {
        $sectionId = 1;
        if($request->has('section_id')){
            $sectionId = $request->input('section_id');
        }
        $sections = Section::orderBy('order', 'asc')->pluck('name', 'id');
        $questions = Question::where('section_id', $sectionId )->orderBy('order', 'asc')->get();
        return view('admin.question.index', compact('questions', 'sections', 'sectionId'));
    }

    public function create()
    {
        $sections = Section::orderBy('order', 'asc')->pluck('name', 'id');
        $types = $this->types;
        return view('admin.question.create', compact('sections', 'types'));
    }

    public function edit(Question $question)
    {
        $sections = Section::orderBy('order', 'asc')->pluck('name', 'id');
        $types = $this->types;
        $answers = $question->answers()->orderBy('order', 'asc')->get();
        return view('admin.question.edit', compact('question', 'answers', 'types', 'sections'));
    }

    public function store(Request $request)
    {
        $rules = [
            'question.label' => 'required|min:3|unique:question,label',
            'question.sentence' => 'required|min:10',
        ];
        if (strpos($request->input('question.type'), 'select')!==false){
            $rules['answers.*.sentence'] = 'required';
            $rules['answers.*.score'] = 'required|numeric';
        }
        $validator = $this->validate($request, $rules);
        if($validator && $validator->fails()){
            return response()->json(['errors'=>$validator->errors()->all()]);
        }

        DB::beginTransaction();
        $question = new Question();
        $question->label = $request->input('question.label');
        $question->sentence = $request->input('question.sentence');
        $question->type = $request->input('question.type');
        $question->order = -1;
        $question->section()->associate(
            Section::find($request->input('question.section_id'))
        );
        $success = $question->save();
        $answers = $request->input('answers');
        if ($answers){
            foreach ($answers as $i => $val){
                $answers[$i]['order'] = $i;
            }
            $success = $question->answers()->createMany($answers);
        }
        if($success){
            DB::commit();
            $request->session()->flash('success_msg', Lang::get('global.question.saved'));
            $request->session()->reflash();
            return response()->json(['redirect' => route('admin.questions.index', ['section_id' => $request->input('question.section_id')])]);
        } else {
            DB::rollback();
            return response()->json(['error'=> Lang::get('global.question.save_failed')]);
        }
    }

    public function update(Request $request, Question $question)
    {
        $rules = [
            'question.label' => 'required|min:3|unique:question,label,'.$question->id.',id',
            'question.sentence' => 'required|min:10',
        ];
        if (strpos($request->input('question.type'), 'select') >= 0){
            $rules['answers.*.sentence'] = 'required';
            $rules['answers.*.score'] = 'required|numeric';
        }
        $validator = $this->validate($request, $rules);
        $question->label = $request->input('question.label');
        $question->sentence = $request->input('question.sentence');
        $question->type = $request->input('question.type');
        $question->section()->associate(
            Section::find($request->input('question.section_id'))
        );
        $success = $question->save();
        if (strpos($question->type, 'select')!==false){
            $answers = $request->input('answers');
            if ($answers){
                foreach ($answers as $i => $val){
                    if (array_key_exists('id', $val)){
                        $ans = Answer::find($val['id']);
                        $ans->sentence = $val['sentence'];
                        $ans->score = $val['score'];
                        $ans->order = $i;
                        $ans->save();
                    }else{
                        $answers[$i]['order'] = $i;
                        $question->answers()->create($answers[$i]);
                    }
                }
            }
        }else{
            $question->answers()->delete();
        }
        return response()->json(['redirect'=> route('admin.questions.index', ['section_id' => $request->input('question.section_id')])]);
    }
}