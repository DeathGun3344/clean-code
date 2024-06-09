<?php

namespace DeathGun\CleanCode\Commons\Errors;

interface HasErrorsInterface
{
    public function addError(Error $error): void;
    public function getErrorCount(): int;
    public function getError(string $field): ?Error;
}
