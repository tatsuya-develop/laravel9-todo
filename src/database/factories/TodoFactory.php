<?php

namespace Database\Factories;

use Carbon\Carbon;
use Infrastructure\EloquentModels\Todo;

/**
 * @extends Factory<Todo>
 */
class TodoFactory extends Factory
{
    use FactoryTrait;

    protected $model = Todo::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'task' => $this->faker->realText,
            'completed' => $this->faker->boolean,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
