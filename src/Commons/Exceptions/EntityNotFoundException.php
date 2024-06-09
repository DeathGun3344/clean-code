<?php

namespace DeathGun\CleanCode\Commons\Exceptions;


use Exception;

class EntityNotFoundException extends Exception
{
    public function __construct(public readonly string $entity, public readonly array $fields = [])
    {
        parent::__construct();
    }
}
