<?php

namespace App\Http\Controllers;

use App\Answer;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    public function destroy(Request $request, Answer $answer)
    {
        $success = $answer->delete();
        return response()->json(['success'=> $success?true:false]);
    }
}
