<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Task;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class TasksController extends Controller
{

    public function index()
    {
        return Cache::remember(20, 'tasks', function() {
            return Task::all();
        });
    }

    public function store(CreateTaskRequest  $request)
    {
        Cache::flush();
        return Task::create($request->all());
    }

    public function show($id)
    {
        return Task::find($id);
    }

    public function update(Request $request, $id)
    {
        Cache::flush();
        return Task::updateOrCreate(compact('id'), $request->all());
    }

    public function destroy($id)
    {
        Cache::flush();
        return Task::destroy($id);
    }
}
