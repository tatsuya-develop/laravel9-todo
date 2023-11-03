<?php

namespace Infrastructure\EloquentModels;

use Database\Factories\TodoFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * Infrastructure\EloquentModels\Todo
 *
 * @property int $id
 * @property string $task
 * @property int $completed
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Todo newModelQuery()
 * @method static Builder|Todo newQuery()
 * @method static Builder|Todo query()
 * @method static Builder|Todo whereCompleted($value)
 * @method static Builder|Todo whereCreatedAt($value)
 * @method
 * static \Illuminate\Database\Eloquent\Builder|Todo whereId($value)
 * @method static Builder|Todo whereTask($value)
 * @method static Builder|Todo whereUpdatedAt($value)
 * @mixin \Eloquent
 */

class Todo extends Model
{
    use HasFactory;
    use EloquentModelTrait;

    protected $guarded = ['id'];

    protected static function newFactory(): TodoFactory|Factory
    {
        return TodoFactory::new();
    }

    public static array $rules = [
        'task' => 'required',
    ];
}
