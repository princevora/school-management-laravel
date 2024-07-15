<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\Tasks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use illuminate\Support\Str;

class TasksController extends Controller
{
    public function AddTask(Request $request){
        if($request->ajax()){
            $validator = Validator::make($request->all(), [
                'standerd' => 'required|numeric',
                'div' => 'required',
                'task_name' => 'required',
                'task' => 'required'
            ]);

            if($validator->fails()){
                return response()->json(['error' => 'Please Fill The All Required Details'], 422);
            }

            //Check If A Task Is Already Running For The Standerd..
            $chk = Tasks::where('std','=', $request->standerd)
                        ->where('div','=', $request->div)
                        ->where('created_at', '>', now()->subDays(1)->endOfDay())
                        ->get();
            
            if($chk->count() > 0){
                return response()->json(['error' => 'A Task Is Already Running For This Standerd Wait for 24hr, or delete A Running one.'], 422);
            }

            //Add Task
            $addTask = new Tasks;
            $addTask->task_name = $request->task_name;
            $addTask->task = $request->task;
            $addTask->std = $request->standerd;
            $addTask->div = $request->div;
            if($addTask->save()){
                return response()->json(['message' => 'succeeded']);
            }
        }
        else{
            return response()->json(['message' => 'Method not supported']);
        }
    }

    public function ViewTasks(Request $request){
        if($request->ajax()){
            $tasks = Tasks::all();
            $html = '
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Task Name</th>
                  <th scope="col">Task</th>
                  <th scope="col">Delete Task</th>
                </tr>
              </thead>
              <tbody>';

                foreach ($tasks as $task) {
                  $html .= '<tr class="">
                                <td scope="row">'.$task->id.'</td>
                                <td>'.$task->task_name.'</td>
                                <td>'.Str::limit($task->task, 20).'</td>
                                <td><button onclick="DeleteTask(this.value)" class="btn btn-light" value="'.$task->id.'" name="deleteTask" id="'.$task->id.'"><i class="fa-solid fa-trash-can"></i></button></td>
                            </tr>';
                }

                $html .= '
              </tbody>
            </table>
          </div>';
            return response()->json([
                'html' => $html,
            ]);
        }
        else{
            return response()->json(['message' => 'Method not supported']);
        }
    }

    public function DeleteTask(Request $request){
        if($request->ajax()){
            $taskId = $request->taskId;
            if(empty($taskId)){
                return response()->json(['error' => 'Please Provide a valid ID'], 422);
            }
            else{
                $task = Tasks::where('id','=',$taskId)->first();
                if($task){
                    if($task->delete()){
                        return response()->json(['message' => 'succeeded']);
                    }
                }
                else{
                    return response()->json(['error' => 'No Task Found'], 422);
                }
            }
        }
        else{
            return response()->json(['message' => 'Method not supported']);
        }
    }
}
