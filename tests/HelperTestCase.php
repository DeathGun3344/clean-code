<?php

namespace DeathGun\CleanCode\Tests;


use DeathGun\CleanCode\Commons\Errors\HasErrorsInterface;
use PHPUnit\Framework\TestCase;

class HelperTestCase extends TestCase
{
    public function assertResponseHasError(HasErrorsInterface $response, string $field, string $message): void
    {
        $this->assertEquals(1, $response->getErrorCount());
        $this->assertNotNull($response->getError($field));
        $this->assertEquals($message, $response->getError($field)->message);
    }

    public function assertResponseHasNoError(HasErrorsInterface $response, string $field, string $message): void
    {
        $this->assertNotEquals($message, $response->getError($field)?->message);
    }
}
