<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Lang;
class QuestionController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->input('sort');
        $order = $request->input('order');
        if (!$sort) {
            $sort = 'label';
            $order = 'asc';
        }
        $questions = Question::orderBy($sort, $order)->paginate(20);
        $links = $questions->appends(['sort' => $sort, 'order' => $order])->links();
        return view('admin.question.index', compact('questions', 'sort', 'order', 'links'));
    }

    public function create(){
        return view('admin.question.create');
    }

    public function edit(Question $question)
    {
        $answers = $question->answers()->orderBy('order', 'asc')->get();
        return view('admin.question.edit', compact('question', 'answers'));
    }

    public function store(Request $request){
        $validator = $this->validate($request, [
            'question.label' => 'required|min:3|unique:question,label',
            'question.sentence' => 'required|min:10',
            'answers.*.sentence' => 'required',
            'answers.*.score' => 'required|numeric',
        ]);
        if($validator && $validator->fails()){
            return response()->json(['errors'=>$validator->errors()->all()]);
        }

        DB::beginTransaction();
        $question = Question::create([
            'label' => $request->input('question.label'),
            'sentence' => $request->input('question.sentence'),
            'choosability' => $request->input('question.multichoice') == "true"? 'multiple' : 'single',
        ]);
        $answers = $request->input('answers');
        foreach ($answers as $i => $val){
            $answers[$i]['order'] = $i;
        }
        $success = $question->answers()->createMany($answers);
        if($success){
            DB::commit();
            $request->session()->flash('success_msg', Lang::get('global.question.saved'));
            $request->session()->reflash();
            return response()->json(['redirect' => url('admin/questions')]);
        } else {
            DB::rollback();
            return response()->json(['error'=> Lang::get('global.question.save_failed')]);
        }
    }

    public function update(Request $request, Question $question)
    {
        $validator = $this->validate($request, [
            'question.label' => 'required|min:3|unique:question,label,'.$question->id.',id',
            'question.sentence' => 'required|min:10',
            'answers.*.sentence' => 'required',
            'answers.*.score' => 'required|numeric',
        ]);
        $question->label = $request->input('question.label');
        $question->sentence = $request->input('question.sentence');
        $question->choosability = $request->input('question.multichoice') == "true"? 'multiple' : 'single';
        $question->save();
        $answers = $request->input('answers');
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
        return response()->json(['redirect'=> url('admin/questions')]);
    }
}