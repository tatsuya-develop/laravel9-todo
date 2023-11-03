<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\Factory as BaseFactory;
use Illuminate\Database\Eloquent\Model;

abstract class Factory extends BaseFactory
{
    private int $currentId = 1;

    /**
     * @param callable|array $attributes
     * @param Model|null $parent
     * @return Collection|Model
     */
    public function make($attributes = [], ?Model $parent = null): Model|Collection
    {
        $model = parent::make($attributes, $parent);

        if ($model instanceof Collection) {
            $model->each(function ($m) {
                if (!property_exists($m, 'id') || is_null($m->id)) {
                    $m->id = $this->currentId++;
                }
            });
        } elseif (!property_exists($model, 'id') || is_null($model->id)) {
            $model->id = $this->currentId++;
        }

        return $model;
    }
}
