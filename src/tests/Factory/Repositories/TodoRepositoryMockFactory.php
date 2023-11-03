<?php

namespace Tests\Factory\Repositories;

use Domain\Repositories\TodoRepositoryInterface;
use Mockery;

class TodoRepositoryMockFactory
{
    public static function createWithErrorOnGetAll(): TodoRepositoryInterface
    {
        $mock = Mockery::mock(TodoRepositoryInterface::class);
        $mock->shouldReceive('getAll')->andThrow(new \Exception());
        return $mock;
    }
}
