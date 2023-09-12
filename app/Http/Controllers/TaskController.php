<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $tasks = Task::where('user_id', $user->id)->get();
        $users = User::all();

        return view('tasks.index', compact('tasks', 'users'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $task = new Task([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'user_id' => $user->id,
        ]);

        $task->save();

        return redirect('/tasks');
    }

    public function update(Request $request, Task $task)
    {
        $task->completed = $request->has('completed');
        $task->save();

        return redirect('/tasks');
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return redirect('/tasks');
    }

    public function checkAcrossAccount(Request $request)
    {
        $users = User::select('id', 'name')->get();

        return view('tasks.check-across-account', compact('users'));
    }

    public function assignTask(Request $request)
    {
        $user = User::find($request->input('user_id'));

        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        $task = new Task([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'user_id' => $user->id,
        ]);

        $task->save();

        return redirect()->back()->with('success', 'Task assigned successfully.');
    }

    public function showCheckAcrossAccountForm()
    {
        $users = User::all();
        return view('tasks.check-across-account', compact('users'));
    }

    public function showAssignTaskForm()
    {
        $users = User::all();
        return view('tasks.assign-task', compact('users'));
    }
}
