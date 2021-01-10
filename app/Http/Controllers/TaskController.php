<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\Task\StoreTaskRequest;
use App\Http\Requests\Api\Task\UpdateTaskRequest;
use App\Http\Resources\Task\Task as TaskResource;
use App\Models\Task;
use App\Models\TaskStatus;
use Illuminate\Support\Carbon;

class TaskController extends Controller
{
    /**
     * Страница со списком задач
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $tasks = Task::ofStatus('active')->get()->each(function ($task) {
            $task->append('reminder');
        });

        return view('task.index', ['tasks' => $tasks]);
    }

    /**
     * Страница создания задачи
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('task.create', ['tasks' => Task::get()]);
    }

    /**
     * Создание задачи
     *
     * @param StoreTaskRequest $request
     * @return TaskResource
     */
    public function store(StoreTaskRequest $request)
    {
        $task = Task::create([
            'user_id' => auth()->user()->id,
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'status_id' => TaskStatus::firstWhere('name', 'active')->id,
            'priority_id' => $request->input('priority'),
            'expiration_date' => Carbon::parse($request->input('expiration_date'))->format('Y-m-d H:i:s')
        ]);

        return new TaskResource($task);
    }

    /**
     * Страница просмотра/редактирования задачи
     *
     * @return \Illuminate\View\View
     */
    public function edit(Task $task)
    {
        $task->expiration_date = Carbon::parse($task->expiration_date)->format('Y-m-d\TH:i');

        return view('task.edit', ['task' => $task]);
    }

    /**
     * Обновление задачи
     *
     * @param Task $task
     * @param UpdateTaskRequest $request
     * @return TaskResource
     */
    public function update(Task $task, UpdateTaskRequest $request)
    {
        $task->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'priority_id' => $request->input('priority'),
            'status_id' => $request->input('status', $task->status->id),
            'expiration_date' => Carbon::parse($request->input('expiration_date'))->format('Y-m-d H:i:s')
        ]);

        return new TaskResource($task);
    }
}
