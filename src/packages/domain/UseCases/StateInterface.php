<?php

namespace Domain\UseCases;

interface StateInterface
{
    public function addError(string $code, ...$args): void;
    public function isError(): bool;
    public function setResponse(string $key, mixed $value): void;
    public function getResponse(string $key): mixed;
}
