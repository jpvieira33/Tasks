<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(Request $request){
        $filteredDate = date('Y-m-d');
        $porcent_isDone = 0;
        $porcent_isDoneFalse = 0;

        if($request->date){
            $filteredDate = $request->date;
        }else{
            $filteredDate = date('Y-m-d');
        }


        $user = Auth::user();

        $tasks = Task::where('user_id', $user->id)->whereDate('due_date', $filteredDate)->get();

        $carbonDate =  Carbon::createFromDate($filteredDate);
        $date_string = $carbonDate->translatedFormat('d') . ' de ' . ucfirst($carbonDate->translatedFormat('M'));
        $date_prev_button = $carbonDate->addDays(-1)->format('Y-m-d');
        $date_next_button = $carbonDate->addDays(+2)->format('Y-m-d');

        $task_count = Task::where('user_id', $user->id)->whereDate('due_date', $filteredDate)->get()->count();
        $task_isDone = Task::where('user_id', $user->id)->where('is_done', false)->whereDate('due_date', $filteredDate)->get()->count();
        $task_isDoneTrue = Task::where('user_id', $user->id)->where('is_done', true)->whereDate('due_date', $filteredDate)->get()->count();

        if($task_count > 0){
            $porcent_isDone = ($task_isDoneTrue/$task_count) * 100;
            $porcent_isDoneFalse = ($task_isDone/$task_count) * 100;
        }


        return view("home", [
            'tasks'=> $tasks,
            'user' => $user,
            'task_count' => $task_count,
            'task_isDone'=> $task_isDone,
            'date_string' => $date_string,
            'date_prev_button' => $date_prev_button,
            'date_next_button'=> $date_next_button,
            'porcent_isDone' => $porcent_isDone,
            'porcent_isDoneFalse' => $porcent_isDoneFalse
        ]);
    }
}
