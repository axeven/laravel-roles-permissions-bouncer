<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;

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
        return redirect()->route('admin.tasks.show', $task);
    }
}