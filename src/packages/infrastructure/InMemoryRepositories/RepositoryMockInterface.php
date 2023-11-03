<?php

namespace Infrastructure\InMemoryRepositories;

interface RepositoryMockInterface
{
    public function setData(array $data): void;
}
