<?php

namespace App\Http\ViewModels;

use Data\Entities\Entity;
use Illuminate\Support\Collection;

class ViewModel
{
    protected Entity $entity;
    private Collection $collection;
    protected array $excludeFields = [];

    public function __construct(Entity $entity)
    {
        $this->entity = $entity;
        $this->collection = collect($entity->toArray());
    }

    public function append(array $attributes = []): void
    {
        collect($attributes)->each(function ($value, $key) {
            $this->collection->put($key, $value);
        });
    }

    public function generate(): array
    {
        return $this->collection->except($this->excludeFields)->toArray();
    }
}
