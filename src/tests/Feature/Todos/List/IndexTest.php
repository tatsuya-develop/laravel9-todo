<?php

namespace Tests\Feature\Todos\List;

use Database\Factories\TodoFactory;
use Domain\Repositories\TodoRepositoryInterface;
use Illuminate\Testing\TestResponse;
use Symfony\Component\HttpFoundation\Response;
use Tests\Factory\Repositories\TodoRepositoryMockFactory;
use Tests\Support\TestCase;

class IndexTest extends TestCase
{
    /**
     * @test
     */
    public function success(): void
    {
        TodoFactory::new()->count(3)->create();

        $response = $this->request();

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonCount(3, 'data');
        $response->assertJsonCount(0, 'errors');
    }

    /**
     * @test
     */
    public function failed(): void
    {
        $this->app->instance(TodoRepositoryInterface::class, TodoRepositoryMockFactory::createWithErrorOnGetAll());

        $response = $this->request();

        $response->assertStatus(Response::HTTP_INTERNAL_SERVER_ERROR);
        $response->assertJsonCount(0, 'data');
        $response->assertJsonCount(1, 'errors');
    }

    private function request(array $query = []): TestResponse
    {
        return $this->get('/api/todos', $query);
    }
}
