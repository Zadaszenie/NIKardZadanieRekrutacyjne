<?php

namespace App\Services;

use App\DTO\StoreTaskRequestDto;
use App\DTO\UpdateTaskRequestDto;
use App\Models\Task;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface TaskServiceInterface
{
    /**
     * @param array<string,mixed> $filters
     * @return LengthAwarePaginator<int, Task>
     */
    public function listTasks(array $filters = []): LengthAwarePaginator;

    /** @return Collection<int, User> */
    public function getObservers(): Collection;
    public function createTask(StoreTaskRequestDto $data): Task;
    public function updateTask(Task $task, UpdateTaskRequestDto $data): bool;

    /** @return string[] */
    public function getStatuses(): array;
}
