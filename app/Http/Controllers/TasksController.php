<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;

class TasksController extends Controller
{
    public function index() {
        return Task::all();
    }

    public function save(Request $request) {
        $task = new Task;
        $task->task = $request->newTask;
        return $task->save();
    }

    public function finished(Request $request) {
        $task = Task::find($request->id);
        $task->finished = !$task->finished;
        return $task->save();
    }

    public function finishedAll(Request $request) {
        return Task::where('finished', 0)->update(['finished' => 1]);
    }

    public function deleteAllFinished(Request $request) {
        return Task::where('finished', 1)->delete();
    }
}
