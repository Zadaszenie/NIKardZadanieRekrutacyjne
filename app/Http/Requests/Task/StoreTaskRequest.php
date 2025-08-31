<?php

namespace App\Http\Requests\Task;


class StoreTaskRequest extends BaseTaskRequest
{
    /**
     * @return array<string,string>
     */
    public function rules(): array
    {
        return $this->baseRules();
    }
}
