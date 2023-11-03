<?php

namespace Infrastructure\InMemoryRepositories;

use Data\Entities\Entity;
use Illuminate\Support\Collection;

class RepositoryMock
{
    private Collection $data;

    public function __construct()
    {
        $this->data = collect([]);
    }

    /**
     * @param array|Collection $data
     */
    public function setData(array|Collection $data): void
    {
        $this->data = collect($data);
    }

    public function getData(): Collection
    {
        return $this->data;
    }
}
