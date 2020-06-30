<?php

declare(strict_types=1);

namespace Dice;

use Exception;
use Psr\Container\ContainerExceptionInterface;

final class ContainerException extends Exception implements ContainerExceptionInterface
{

}
