<?php

namespace App\Http\Controllers;

use App\Jobs\TaskSendEmail;
use App\Mail\TaskEmail;
use App\Models\Category;
use App\Models\Task;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class TaskController extends Controller
{
    public function index(){
        return view("");
    }

    public function create(Request $request){
        $categories = Category::all();
        $data['categories'] = $categories;

        return view("task.create", $data);
    }

    public function create_action(Request $request){
        $task = $request->only(['title', 'due_date', 'category_id', 'description']);

        $user = Auth::user();
        $task['user_id'] = $user->id;

        $task_created =  Task::create($task);
        TaskSendEmail::dispatch($task_created, $user);

        return redirect(route('home'));
    }

    public function edit(Request $request){
        $id = $request->id;
        $task = Task::find($id);

        if(!$task){
            return redirect(route('home'));
        }
        $categories = Category::all();
        $data['categories'] = $categories;
        $data['task'] = $task;

       // dd($data);

        return view("task.edit", $data);
    }

    public function edit_action(Request $request){
        $dados = $request->only(['title', 'due_date', 'category_id', 'description']);
        $task =  Task::find($request->id);

        $dados['is_done'] = $request->is_done ? true : false;

        if(!$task){
            return 'Task não existe';
        }

        $task->update($dados);
        $task->save();
        return redirect(route('home'));
    }

    public function delete(Request $request){
        $id = $request->id;

        $task = Task::find($id);

        if($task){
            $task->delete();
        }

        return redirect(route('home'));
    }

    public function update(Request $request){
      $task = Task::findOrFail($request->taskId);
      $task->is_done = $request->isDone;
      $task->save();
      return ['success' => true];
    }
}
