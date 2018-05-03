<?php

namespace App\Http\Controllers;

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

    public function store(Request $request){
        $messages = [
            'required' => Lang::get('messages.required'),
            'min' => Lang::get('messages.min'),
            'numeric' => Lang::get('messages.numeric'),
        ];
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
            'choosability' => $request->has('question.multichoice') ? 'multiple' : 'single',
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
            return response()->json([
                'redirect' => url('admin/questions')
                ]);
        } else {
            DB::rollback();
            return response()->json(['error'=> Lang::get('global.question.save_failed')]);
        }
    }
}