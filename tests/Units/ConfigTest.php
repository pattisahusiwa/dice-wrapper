<?php

declare(strict_types=1);

use Dice\Dice;
use Dice\DiceWrapper;
use Dice\Test\CheckConstructorArgs;
use PHPUnit\Framework\TestCase;

final class ConfigTest extends TestCase
{
    /** @var DiceWrapper */
    private $dic;

    public function setup()
    {
        $dice = new Dice();
        $dice = $dice->addRules(__DIR__ . '/rules.json');
        $this->dic = new DiceWrapper($dice);
    }

    public function tearDown()
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
}
