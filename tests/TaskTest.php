<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TaskTest extends TestCase
{

    use WithoutMiddleware, DatabaseTransactions;

    protected $task;


    public function testPostTask()
    {
        $this->task = $this->makeTask();
        $this->post('tasks', ['title' => $this->task->title, 'description' => $this->task->description])->seeInDatabase('tasks',['title' => $this->task->title])
             ->seeInDatabase('tasks', ['title' => $this->task->title]);

    }

    public function testViewTask()
    {
        $this->get('tasks/1')
             ->seeJson();
    }

    public function testUpdateTask()
    {
        $this->task = $this->makeTask();
        $this->put('tasks/1', ['title' => $this->task->title, 'description' => $this->task->description ])
             ->seeInDatabase('tasks', ['title' => $this->task->title]);

    }

    public function testDeleteTask()
    {
        $this->delete('tasks/1')
             ->notSeeInDatabase('tasks',['id' => 1]);

    }

    private function makeTask()
    {
        return factory(App\Task::class)->make();
    }


}
