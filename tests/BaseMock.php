<?php

namespace DeathGun\CleanCode\Tests;

use PHPUnit\Framework\MockObject\Builder\InvocationMocker;
use PHPUnit\Framework\MockObject\MockBuilder;
use PHPUnit\Framework\MockObject\Rule\InvokedCount as InvokedCountMatcher;
use PHPUnit\Framework\TestCase;

abstract class BaseMock
{
    protected $mock;

    public function __construct(TestCase $testCase)
    {
        $this->initMock($testCase);
    }

    private function initMock(TestCase $testCase): void
    {
        $builder = (new MockBuilder($testCase, $this->getClassName()));

        if(!empty($this->methods())) {
            $builder = $builder->onlyMethods($this->methods());
        }

        $this->mock = $builder->getMock();
    }

    abstract protected function getClassName(): string;

    public function getMock()
    {
        return $this->mock;
    }

    public function once(): InvocationMocker
    {
        return $this->mock->expects(new InvokedCountMatcher(1));
    }

    public function never(): InvocationMocker
    {
        return $this->mock->expects(new InvokedCountMatcher(0));
    }

    protected function methods(): array
    {
        return [];
    }
}
