<?php

namespace App\Repositories;

use App\Models\Task;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class TaskRepository
{
    /**
     * @param array{
     *     q?: string|null,
     *     status?: string|null,
     *     due_from?: string|null,
     *     due_to?: string|null,
     *     per_page?: int|null
     * } $filters
     *
     * @return LengthAwarePaginator<int, Task>
     */
    public function listTasks(array $filters = []): LengthAwarePaginator
    {
        /** @var User|bool $user */
        $user = Auth::user();
        if ($user instanceof User !== true) {
            throw new \RuntimeException('User must be authenticated');
        }

        $query = Task::query()
            ->where(fn($q) => $q
                ->where('user_id', $user->id)
                ->orWhere('observer_id', $user->id)
            )
            ->search($filters['q'] ?? null)
            ->status($filters['status'] ?? null)
            ->dueFrom($filters['due_from'] ?? null)
            ->dueTo($filters['due_to'] ?? null)
            ->latest();

        $perPage = isset($filters['per_page']) ? (int) $filters['per_page'] : 10;

        return $query->paginate($perPage)->withQueryString();
    }

    /**
     * @return Collection<int, User>
     */
    public function getObservers(): Collection
    {
        return User::orderBy('name')->get(['id', 'name']);
    }
}
