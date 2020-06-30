<?php

declare(strict_types=1);

namespace Dice\Test;

use Psr\Container\ContainerInterface;

final class DiceWrapperDependant
{
    public $dic;

    public function __construct(ContainerInterface $dic)
    {
        $this->dic = $dic;
    }
}
