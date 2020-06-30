<?php

namespace Dice\Test;

class CheckConstructorArgs
{
    public $arg1;

    public function __construct($arg1)
    {
        $this->arg1 = $arg1;
    }
}
