<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Task;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class TasksController extends Controller
{

    public function index()
    {
        return Task::all();
    }

    public function store(CreateTaskRequest  $request)
    {
        return Task::create($request->all());
    }

    public function show($id)
    {
        return Task::find($id);
    }

    public function update(UpdateTaskRequest $request, $id)
    {
        return Task::updateOrCreate(compact('id'), $request->all());
    }

    public function destroy($id)
    {
        return Task::destroy($id);
    }
}
