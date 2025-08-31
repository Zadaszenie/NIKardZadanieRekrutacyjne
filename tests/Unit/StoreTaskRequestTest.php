<?php

use App\DTO\StoreTaskRequestDto;
use App\Enum\TaskStatus;
use App\Http\Requests\Task\StoreTaskRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class StoreTaskRequestTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function valid_data_passes_validation(): void
    {
        $rules = (new StoreTaskRequest())->rules();

        $validator = Validator::make([
            'title' => 'My task',
            'status' => TaskStatus::New->value,
        ], $rules);

        $this->assertTrue($validator->passes());
    }

    #[Test]
    public function missing_title_fails_validation(): void
    {
        $rules = (new StoreTaskRequest())->rules();

        $validator = Validator::make([
            'status' => TaskStatus::New->value,
        ], $rules);

        $this->assertFalse($validator->passes());
        $this->assertArrayHasKey('title', $validator->errors()->toArray());
    }
}
