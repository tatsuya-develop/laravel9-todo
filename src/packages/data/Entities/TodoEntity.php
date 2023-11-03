<?php

namespace Data\Entities;

use App\Exceptions\ValidationErrorException;
use App\Helpers\Word;
use Data\ValueObjects\Common\BoolValue;
use Data\ValueObjects\Common\NotBlankString;
use Data\ValueObjects\Common\PositiveNumber;

class TodoEntity extends Entity
{
    private PositiveNumber $id;
    private NotBlankString $task;
    private BoolValue $completed;

    /**
     * @throws ValidationErrorException
     */
    public function __construct(array $attributes)
    {
        parent::__construct($attributes);

        $this->id = new PositiveNumber($attributes['id'], Word::field('Todo.id'));
        $this->task = new NotBlankString($attributes['task'], Word::field('Todo.task'));
        $this->completed = new BoolValue($attributes['completed']);
    }

    public function getId(): PositiveNumber
    {
        return $this->id;
    }

    public function getIdValue(): int
    {
        return $this->getId()->getValue();
    }

    public function getTask(): NotBlankString
    {
        return $this->task;
    }

    public function getTaskValue(): string
    {
        return $this->getTask()->getValue();
    }

    public function getCompleted(): BoolValue
    {
        return $this->completed;
    }

    public function getCompletedValue(): bool
    {
        return $this->getCompleted()->getValue();
    }
}
