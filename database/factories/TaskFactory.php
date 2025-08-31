<?php

namespace Database\Factories;

use App\Enum\TaskStatus;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends Factory<Task>
 */
class TaskFactory extends Factory
{
    protected $model = Task::class;

    public function definition(): array
    {
        $owner = User::factory()->create();
        $observer = User::factory()->create();

        return [
            'title'       => fake()->sentence(3),
            'description' => fake()->optional()->paragraph(),
            'status'      => fake()->randomElement(TaskStatus::values()),
            'due_date'    => fake()->optional()->dateTimeBetween('now', '+1 month'),
            'user_id'     => $owner->id,
            'observer_id' => $observer->id,
        ];
    }
}
