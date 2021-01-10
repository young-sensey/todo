<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Class TaskPriority
 * @package App\Models
 *
 * @property int $id идентификатор
 * @property string $name название
 * @property Collection $tasks задачи
 */
class TaskPriority extends Model
{
    use HasFactory;

    /**
     * @inheritdoc
     */
    protected $table = 'task_priorities';

    /**
     * @inheritDoc
     */
    public $timestamps = false;

    /**
     * @inheritDoc
     */
    protected $fillable = [
        'name'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
