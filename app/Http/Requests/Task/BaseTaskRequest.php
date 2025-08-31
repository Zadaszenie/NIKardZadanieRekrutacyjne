<?php

namespace App\Http\Requests\Task;

use Illuminate\Foundation\Http\FormRequest;
use App\Enum\TaskStatus;

abstract class BaseTaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array{title: string, description: string, status: string, due_date: string, observer_id: string}
     */
    protected function baseRules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:' . implode(',', TaskStatus::values()),
            'due_date' => 'nullable|date',
            'observer_id' => 'nullable|exists:users,id',
        ];
    }
}
