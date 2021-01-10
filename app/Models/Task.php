<?php

namespace App\Models;

use App\Scopes\UserScope;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * Class Task
 * @package App\Models
 *
 * @property int $id идентификатор
 * @property int $user_id id пользователя
 * @property string $title заголовок
 * @property string $description описание
 * @property int $status_id id статуса
 * @property int $priority_id id приоритета
 * @property Carbon $expiration_date время завершения
 * @property Carbon $created_at время создания
 * @property Carbon $updated_at время обновления
 * @property string $reminder напоминание, сколько времени осталось до завершения
 * @property User $user пользователь
 * @property TaskStatus $status статус
 * @property TaskPriority $priority приоритет
 *
 */
class Task extends Model
{
    use HasFactory;

    /**
     * @inheritDoc
     */
    protected $fillable = [
        'user_id', 'title', 'description', 'status_id', 'priority_id', 'expiration_date'
    ];

    /**
     * @inheritDoc
     */
    protected $with = [
        'status', 'priority'
    ];

    /**
     * @inheritDoc
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new UserScope);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status()
    {
        return $this->belongsTo(TaskStatus::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function priority()
    {
        return $this->belongsTo(TaskPriority::class);
    }

    /**
     * Напоминание, сколько времени осталось до завершения
     *
     * @return string
     */
    public function getReminderAttribute()
    {
        $expirationDate = Carbon::parse($this->expiration_date);
        $nowDate = Carbon::now();
        $prefix = $nowDate->diffInMinutes($expirationDate, false) > 0 ? ' left' : ' have passed';
        return $expirationDate->diffForHumans($nowDate, ['syntax' => CarbonInterface::DIFF_ABSOLUTE]) . $prefix;
    }

    /**
     * Scope a query to only include tasks of a given status.
     *
     * @param  Builder  $query
     * @param  mixed  $statusName
     * @return Builder
     */
    public function scopeOfStatus($query, $statusName)
    {
        return $query->whereHas('status', function ($query) use ($statusName) {
            return $query->where('name', '=', $statusName);
        });
    }

    /**
     * Scope a query to only include tasks of a given priority.
     *
     * @param  Builder  $query
     * @param  mixed  $priorityName
     * @return Builder
     */
    public function scopeOfPriority($query, $priorityName)
    {
        return $query->whereHas('priority', function ($query) use ($priorityName) {
            return $query->where('name', '=', $priorityName);
        });
    }
}
