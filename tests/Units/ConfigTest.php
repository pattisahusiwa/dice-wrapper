<?php

declare(strict_types=1);

use Dice\ContainerException;
use Dice\Dice;
use Dice\DiceWrapper;
use Dice\Test\CheckConstructorArgs;
use Dice\Test\DicePdoDriver;
use PHPUnit\Framework\TestCase;

final class ConfigTest extends TestCase
{
    /** @var DiceWrapper */
    private $dic;

    protected function setup()
    {
        $dice = new Dice();
        $dice = $dice->addRules(__DIR__ . '/rules.json');
        $this->dic = new DiceWrapper($dice);
    }

    protected function tearDown()
    {
        $this->dic = null;
    }

    public function testCreate()
    {
        $obj = $this->dic->get(ReflectionClass::class);
        $this->assertInstanceOf(ReflectionClass::class, $obj);
    }

    public function testCreateFromVariable()
    {
        $obj = $this->dic->get('$check');
        $this->assertInstanceOf(CheckConstructorArgs::class, $obj);
    }

    public function testCreateOverrideRule()
    {
        $obj = $this->dic->get(CheckConstructorArgs::class);
        $this->assertInstanceOf(CheckConstructorArgs::class, $obj);
    }

    public function testHasClass()
    {
        $this->assertTrue($this->dic->has(ReflectionClass::class));
    }

    public function testHasClassVariable()
    {
        $this->assertTrue($this->dic->has('$check'));
    }

    public function testHasGlobalRule()
    {
        $this->assertFalse($this->dic->has('*'));
    }

    public function testHandlePdoException()
    {
        $this->expectException(ContainerException::class);
        $this->expectExceptionCode(1);

        $this->dic->get(DicePdoDriver::class);
    }
}
