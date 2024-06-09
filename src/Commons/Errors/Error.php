<?php

namespace DeathGun\CleanCode\Commons\Errors;

readonly class Error
{

    public function __construct(
        public string $field,
        public string $message,
    )
    {

    }

    public static function create(string $field, string $message): self
    {
        return new self($field, $message);
    }
}
