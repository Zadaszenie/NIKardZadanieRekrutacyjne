<?php

namespace App\Services;

use App\DTO\StoreTaskRequestDto;
use App\DTO\UpdateTaskRequestDto;
use App\Enum\TaskStatus;
use App\Models\Task;
use App\Repositories\TaskRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class TaskService implements TaskServiceInterface
{
    protected TaskRepository $repo;

    public function __construct(TaskRepository $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @return string[]
     */
    public function getStatuses(): array
    {
        return TaskStatus::labels();
    }

    /**
     * @param array{
     *     q?: string|null,
     *     status?: string|null,
     *     due_from?: string|null,
     *     due_to?: string|null,
     *     per_page?: int|null
     * } $filters
     */
    public function listTasks(array $filters = []): LengthAwarePaginator
    {
        return $this->repo->listTasks($filters);
    }

    public function getObservers(): Collection
    {
        return $this->repo->getObservers();
    }

    public function createTask(StoreTaskRequestDto $data): Task
    {
        return Task::create($data->toArray());
    }

    public function updateTask(Task $task, UpdateTaskRequestDto $data): bool
    {
        return $task->update($data->toArray());
    }
}
