<?php

use Dice\Dice;
use Dice\DiceWrapper;
use Dice\Test\DiceWrapperDependant;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

final class ContainerTest extends TestCase
{
    /** @var DiceWrapper */
    private $dic;

    public function setup()
    {
        $dice = new Dice();
        $this->dic = new DiceWrapper($dice);
    }

    public function tearDown()
    {
        $this->dic = null;
    }

    public function testCheckingForUnknownClass()
    {
        $this->assertFalse($this->dic->has('\NotExistClass'));
    }

    public function testCheckExistClass()
    {
        $this->getMockBuilder('TestCreate')->getMock();
        $this->assertTrue($this->dic->has('TestCreate'));
    }

    public function testCreate()
    {
        $this->getMockBuilder('TestCreate')->getMock();
        $obj = $this->dic->get('TestCreate');
        $this->assertInstanceOf('TestCreate', $obj);
    }

    public function testCreateUnknownClass()
    {
        $this->expectException(NotFoundExceptionInterface::class);
        $this->expectExceptionMessage('Could not instantiate \NotExistClass');

        $this->dic->get('\NotExistClass');
    }

    public function testCreateFail()
    {
        $this->expectException(ContainerExceptionInterface::class);

        $this->dic->get(ReflectionClass::class);
    }

    public function testSelfInstance()
    {
        $obj = $this->dic->get(DiceWrapperDependant::class);
        $this->assertSame($this->dic, $obj->dic);
    }

    public function testSharedDiceWrapper()
    {
        $objA = $this->dic->get(DiceWrapperDependant::class);
        $objB = $this->dic->get(DiceWrapperDependant::class);

        $this->assertNotSame($objA, $objB);
        $this->assertSame($objA->dic, $objB->dic);
    }
}
