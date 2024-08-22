<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class HomeController extends Controller
{
    public function index()
    {
        return view('index');
    }
    public function saveTask(Request $request)
    {

        $oldTask = Task::where('task', $request->input)->get()->toArray();
        if (!empty($oldTask)) {
            return response()->json(['success' => false, 'msg' => 'Task with this name already exist']);
        } else {
            $task = new Task;
            $task->task = $request->input;
            $task->status = Task::STATUS_NOT_COMPLETED;
            $task->save();

            return response()->json(['success' => true, 'msg' => "Task Added Successfully"]);
        }
    }


    public function getTask(Request $request)
    {
        if (isset($request->status)) {
            $tasks = Task::where('status', $request->status)->get()->toArray();
        }else{
            $tasks = Task::get()->toArray();
        }
        $html = '';
        $i = 1;
        foreach ($tasks as $task) {
            $html .= '<tr>';
            $html .= "<th scope='row'> {$i} </th>";
            $html .= "<td>{$task['task']}</td>";
            $html .= "<td>" . ($task['status'] == 1 ? 'Completed' : 'Not Completed') . "</td>";
            $html .= "<td><button type='button' onclick='markAsCompleted(".$task['id'].")'  class='btn btn-success'><i class='fa fa-check' aria-hidden='true'></i></button>
                        <button type='button' onclick='deleteTask(".$task['id'].")' class='btn btn-danger'><i class='fa fa-times' aria-hidden='true'></i></button></td>";
            $html .= "</tr>";
            $i++;
        }

        echo $html;
    }

    public function deleteTask(Request $request){
        $id = $request->id;
        $task = Task::findOrFail($id);
        if(!empty($task)){
            $task->delete();
        }
        return response()->json(['success' => true, 'msg' => "Task Deleted Successfully"]);
    }
   
    public function markAsCompleted(Request $request){
        $id = $request->id;
        $task = Task::findOrFail($id);
        if(!empty($task)){
            $task->status = Task::STATUS_COMPLETED;
            $task->save();
        }
        return response()->json(['success' => true, 'msg' => "Task Updated Successfully"]);
    }
}
