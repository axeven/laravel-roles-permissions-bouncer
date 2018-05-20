<?php

namespace App\Http\Controllers;

use Auth;
use App\Survey;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ReportController extends Controller
{
    public function index(Request $request){
        if (Gate::allows('report_browse') && $request->has('user_id')) {   
            $user =User::find($request->input('user_id'));
        }else {
            $user = Auth::user();
        }
        if (!$user->canViewReport()){
            return redirect()->route('survey.add');
        }
        $surveys = $user->surveys()->get();
        
    }
}
