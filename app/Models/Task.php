<?php

namespace App\Models;

use Database\Factories\TaskFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $user_id
 * @property int|null $observer_id
 * @property string $title
 * @property string|null $description
 * @property string $status
 * @property Carbon|null $due_date
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read User|null $observer
 * @property-read User $user
 * @method static TaskFactory factory($count = null, $state = [])
 * @method static Builder<Task> newModelQuery()
 * @method static Builder<Task> newQuery()
 * @method static Builder<Task> query()
 * @method static Builder<Task> dueFrom(?string $from)
 * @method static Builder<Task> dueTo(?string $to)
 * @method static Builder<Task> search(?string $term)
 * @method static Builder<Task> status(?string $status)
 * @method static Builder<Task> whereCreatedAt($value)
 * @method static Builder<Task> whereDescription($value)
 * @method static Builder<Task> whereDueDate($value)
 * @method static Builder<Task> whereId($value)
 * @method static Builder<Task> whereObserverId($value)
 * @method static Builder<Task> whereStatus($value)
 * @method static Builder<Task> whereTitle($value)
 * @method static Builder<Task> whereUpdatedAt($value)
 * @method static Builder<Task> whereUserId($value)
 * @mixin \Eloquent
 */
class Task extends Model
{
    /** @use HasFactory<TaskFactory> */
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'status', 'due_date', 'user_id', 'observer_id'
    ];

    protected $casts = [
        'due_date' => 'date',
    ];

    /**
     * @return BelongsTo<User, $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo<User, $this>
     */
    public function observer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'observer_id');
    }

    /**
     * @param Builder<Task> $query
     * @param string|null $term
     * @return Builder<Task>
     */
    public function scopeSearch(Builder $query, ?string $term): Builder
    {
        if (!$term) return $query;
        return $query->where(function (Builder $q) use ($term) {
            $q->where('title', 'like', "%{$term}%")
                ->orWhere('description', 'like', "%{$term}%");
        });
    }

    /**
     * @param Builder<Task> $query
     * @param string|null $status
     * @return Builder<Task>
     */
    public function scopeStatus(Builder $query, ?string $status): Builder
    {
        if (!$status) return $query;
        return $query->where('status', $status);
    }

    /**
     * @param Builder<Task> $query
     * @param string|null $from
     * @return Builder<Task>
     */
    public function scopeDueFrom(Builder $query, ?string $from): Builder
    {
        if (!$from) return $query;
        return $query->whereDate('due_date', '>=', $from);
    }

    /**
     * @param Builder<Task> $query
     * @param string|null $to
     * @return Builder<Task>
     */
    public function scopeDueTo(Builder $query, ?string $to): Builder
    {
        if (!$to) return $query;
        return $query->whereDate('due_date', '<=', $to);
    }
}
