<?php

namespace Data\Entities;

use App\Const\DateFormat;
use Illuminate\Support\Carbon;

class Entity
{
    protected Carbon $createdAt;

    protected Carbon $updatedAt;

    public function __construct(array $attributes)
    {
        $this->createdAt = Carbon::parse($attributes['created_at']);
        $this->updatedAt = Carbon::parse($attributes['updated_at']);
    }

    /**
     * @return array{key: string, value: mixed}
     */
    public function toArray(): array
    {
        $reflectionClass = new \ReflectionClass($this);
        $array = [];
        foreach ($reflectionClass->getProperties() as $property) {
            $property->setAccessible(true);
            $key = $property->getName();
            $value = $property->getValue($this);
            if (is_a($value, Carbon::class)) {
                // Y-m-d H:i:s をデフォルトとする
                $array[$key] = $value->format('Y-m-d H:i:s');
            } elseif (is_object($value) && method_exists($value, 'getValue')) {
                $array[$key] = $value->getValue();
            } else {
                $array[$key] = $value;
            }
        }
        return $array;
    }

    public function getCreatedAt(): Carbon
    {
        return $this->createdAt;
    }

    public function getCreatedAtValue(string $format = DateFormat::DATE_TIME): string
    {
        return $this->getCreatedAt()->format($format);
    }

    public function getUpdatedAt(): Carbon
    {
        return $this->updatedAt;
    }

    public function getUpdatedAtValue(string $format = DateFormat::DATE_TIME): string
    {
        return $this->getUpdatedAt()->format($format);
    }
}
