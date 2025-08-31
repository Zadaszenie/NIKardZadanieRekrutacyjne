<?php

namespace App\Providers;

use App\Models\Task;
use App\Policies\TaskPolicy;
use App\Services\TaskService;
use App\Services\TaskServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * @var array<class-string, class-string>
     */
    protected array $policies = [
        Task::class => TaskPolicy::class,
    ];

    public function register(): void
    {
        $this->app->bind(
            TaskServiceInterface::class,
            TaskService::class
        );
    }

    public function boot(): void
    {
        //
    }
}
