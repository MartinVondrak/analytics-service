<?php

namespace Resolver;

use MartinVondrak\AnalyticsService\Entity\Customer;
use MartinVondrak\AnalyticsService\Enum\CustomerActionEnum;
use MartinVondrak\AnalyticsService\Resolver\CustomerActionResolver;
use PHPUnit\Framework\TestCase;

class CustomerActionResolverTest extends TestCase
{
    /** @var CustomerActionResolver */
    private $customerActionResolver;

    public function setUp(): void
    {
        parent::setUp();
        $this->customerActionResolver = new CustomerActionResolver();
    }

    public function testResolve(): void
    {
        $alan = new Customer('ALAN', 100, new \DateTime('-1 day'));
        $alanAction = $this->customerActionResolver->resolve($alan);
        $this->assertEquals(CustomerActionEnum::SMS_ACTION, $alanAction->getAction());
        $this->assertEquals($alan->getName(), $alanAction->getName());

        $alex = new Customer('ALEX', 500, new \DateTime('-1 year'));
        $alexAction = $this->customerActionResolver->resolve($alex);
        $this->assertEquals(CustomerActionEnum::SMS_ACTION, $alexAction->getAction());
        $this->assertEquals($alex->getName(), $alexAction->getName());

        $victor = new Customer('VICTOR', 300, new \DateTime('-1 month'));
        $victorAction = $this->customerActionResolver->resolve($victor);
        $this->assertEquals(CustomerActionEnum::SMS_ACTION, $victorAction->getAction());
        $this->assertEquals($victor->getName(), $victorAction->getName());

        $caroline = new Customer('CAROLINE', 1000, new \DateTime('-1 month'));
        $carolineAction = $this->customerActionResolver->resolve($caroline);
        $this->assertEquals(CustomerActionEnum::NONE_ACTION, $carolineAction->getAction());
        $this->assertEquals($caroline->getName(), $carolineAction->getName());
    }
}
