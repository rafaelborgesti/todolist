<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\Status;
use Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class TaskController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('task.index');
    }

    public function list()
    { 
        $tasks_pending = Task::where('status_id', '=', 1)->where('user_id', '=', Auth::user()->id)->orderBy('id', 'desc')->get();
        $tasks_completed = Task::where('status_id', '=', 2)->where('user_id', '=', Auth::user()->id)->orderBy('id', 'desc')->get();

        return response()->json([
            'status'=>'success','html'=>view('task.list',compact('tasks_pending','tasks_completed'))->render()
        ],200);
    }

    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'task' => 'required|max:255'
        ]);
        if ( $validator->fails() ) {
            $errors = $validator->errors();
            return response()->json([
                'status'=>'error','html'=>view('task.message',compact('errors'))->render()
            ],200);
        }
        $task = new Task();
        $task->task = $request->task;
        $task->task_uuid = Str::uuid();
        $task->status_id = 1;
        $task->user_id = Auth::user()->id;
        $task->save();

        \Session::flash('flash_message',['message'=>'Successfully added!','class'=>"alert-success",]);
        return response()->json(['status'=>'success','html'=>view('task.message')->render()],200);
    }

    public function edit(Request $request,$task_uuid)
    {
        $validator = Validator::make($request->all(), [
            'task' => 'required|max:255'
        ]);
        if ( $validator->fails() ) {
            $errors = $validator->errors();
            return response()->json([
                'status'=>'error','html'=>view('task.message',compact('errors'))->render()
            ]);
        }
        $task =  \App\Task::where('task_uuid', '=', $task_uuid)
            ->where('status_id', '=', 1)
            ->where('user_id', '=', Auth::user()->id)->first();
        $task->task = $request->input('task');
        $task->update();
        
        \Session::flash('flash_message',['message'=>'Updated successfully!','class'=>"alert-success",]);
        return response()->json(['status'=>'success','html'=>view('task.message')->render()],200);
    }

    public function delete($task_uuid)
    {
        $task = \App\Task::where('task_uuid', '=', $task_uuid)
            ->where('user_id', '=', Auth::user()->id)->delete();
        
        \Session::flash('flash_message',['message'=>'Successfully deleted!','class'=>"alert-success",]);
        return response()->json(['status'=>'success','html'=>view('task.message')->render()],200);
    }

    public function close(Request $request, $task_uuid)
    {
        $task =  \App\Task::where('task_uuid', '=', $task_uuid)
            ->where('status_id', '=', 1)
            ->where('user_id', '=', Auth::user()->id)->first();
        $task->status_id = 2;
        $task->update();
                
        \Session::flash('flash_message',['message'=>'Successfully completed!','class'=>"alert-success",]);
        return response()->json(['status'=>'success','html'=>view('task.message')->render()],200);
    }

}
