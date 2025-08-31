<?php

namespace App\Http\Requests\Task;

use App\Enum\TaskStatus;

class UpdateTaskRequest extends BaseTaskRequest
{
    /**
     * @return array<string,string>
     */
    public function rules(): array
    {
        $rules = $this->baseRules();

        $rules['title'] = 'sometimes|string|max:255';
        $rules['status'] = 'sometimes|in:' . implode(',', TaskStatus::values());

        return $rules;
    }
}
