<?php

namespace App\DTO;

use App\Enum\TaskStatus;
use Carbon\Carbon;
use Spatie\DataTransferObject\DataTransferObject;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class UpdateTaskRequestDto extends DataTransferObject
{
    public string $title;
    public ?string $description;
    public string $status;
    public ?Carbon $dueDate;
    public ?int $observerId;

    /**
     * @return array{title: string, description: null|string, status: string, due_date: null|string, observer_id: int|null}
     */
    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status,
            'due_date' => $this->dueDate?->toDateString(),
            'observer_id' => $this->observerId,
        ];
    }
}
