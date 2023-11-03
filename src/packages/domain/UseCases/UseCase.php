<?php

namespace Domain\UseCases;

interface UseCase
{
    public function invokeStrict(): StateInterface;
    public function validate(): StateInterface;
    public function invoke(): StateInterface;
    public function phaseValidate(): void;
    public function phaseInvoke(): void;
    public function phaseFinalize(): void;
}
