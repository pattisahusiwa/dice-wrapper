<?php

use Dice\Dice;
use Dice\DiceWrapper;
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

    public function testHasClass()
    {
        $this->assertTrue($this->dic->has(ReflectionClass::class));
    }

    public function testHasClassVariable()
    {
        $this->assertTrue($this->dic->has('$dice'));
    }

    public function testHasGlobalRule()
    {
        $this->assertFalse($this->dic->has('*'));
    }
}
