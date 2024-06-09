<?php

namespace DeathGun\CleanCode\Commons\Handlers;

use Assert\LazyAssertionException;
use DeathGun\CleanCode\Commons\Errors\Error;

class LazyAssertionExceptionHandler
{
    public static function handle(LazyAssertionException $exception): array
    {
        $errors = [];
        foreach ($exception->getErrorExceptions() as $errorException) {
            $errors[] = Error::create(
                $errorException->getPropertyPath(),
                $errorException->getMessage(),
            );
        }
        return $errors;
    }
}
