<?php

namespace App\Http\Controllers;

use App\DTO\StoreTaskRequestDto;
use App\DTO\UpdateTaskRequestDto;
use App\Http\Requests\Task\StoreTaskRequest;
use App\Http\Requests\Task\UpdateTaskRequest;
use App\Models\Task;
use App\Services\TaskServiceInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class TaskController extends Controller
{
    protected TaskServiceInterface $taskService;

    public function __construct(TaskServiceInterface $taskService)
    {
        $this->middleware('auth');
        $this->taskService = $taskService;
    }

    public function index(Request $request): Response|RedirectResponse
    {
        /** @var array<string,mixed> $filters */
        $filters = $request->all();
        $tasks = $this->taskService->listTasks($filters);

        return response()->view('tasks.index', [
            'tasks' => $tasks,
            'statuses' => $this->taskService->getStatuses(),
        ]);
    }

    public function create(): Response|RedirectResponse
    {
        return response()->view('tasks.form', [
            'observers' => $this->taskService->getObservers(),
            'statuses' => $this->taskService->getStatuses(),
        ]);
    }

    /**
     * @throws UnknownProperties
     */
    public function store(StoreTaskRequest $request): Response|RedirectResponse
    {
        $this->taskService->createTask((new StoreTaskRequestDto(array_merge(
            $request->validated(),
            ['userId' => (int)auth()->id()]
        ))));
        return redirect()->route('tasks.index')->with('success', 'Zadanie utworzone.');
    }

    public function edit(Task $task): Response|RedirectResponse
    {
        return response()->view('tasks.form', [
            'task' => $task,
            'observers' => $this->taskService->getObservers(),
            'statuses' => $this->taskService->getStatuses(),
        ]);
    }

    /**
     * @throws UnknownProperties
     */
    public function update(UpdateTaskRequest $request, Task $task): Response|RedirectResponse
    {
        $this->taskService->updateTask($task, new UpdateTaskRequestDto($request->validated()));

        return redirect()->route('tasks.index')->with('success', 'Zadanie zaktualizowane.');
    }

    public function destroy(Task $task): Response|RedirectResponse
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Zadanie usunięte.');
    }

    public function show(Task $task): Response|RedirectResponse
    {
        return response()->view('tasks.show', [
            'task' => $task,
            'statuses' => $this->taskService->getStatuses(),
        ]);
    }
}
