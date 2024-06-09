<?php

namespace DeathGun\CleanCode\Builders;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

abstract class BaseBuilder
{
    protected UuidInterface $id;

    public function __construct()
    {
        $this->id = Uuid::uuid4();
    }

    public function withId(UuidInterface $id): self
    {
        $this->id = $id;
        return $this;
    }

    abstract public function build(): Entity;
}