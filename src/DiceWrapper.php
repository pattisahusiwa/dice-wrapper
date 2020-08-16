<?php

declare(strict_types=1);

namespace Dice;

use Psr\Container\ContainerInterface;
use Throwable;

final class DiceWrapper implements ContainerInterface
{
    /** @var Dice */
    private $dice;

    public function __construct(Dice $dice)
    {
        $rule = ['substitutions' => [ContainerInterface::class => $this]];
        $this->dice = $dice->addRule('*', $rule);
    }

    public function get($id)
    {
        if ($this->has($id) === false) {
            throw new NotFoundException('Could not instantiate ' . $id);
        }

        try {
            return $this->dice->create($id);
        } catch (Throwable $th) {
            $code = is_int($th->getCode()) ? $th->getCode() : 1;
            throw new ContainerException($th->getMessage(), $code, $th);
        }
    }

    public function has($id)
    {
        return (class_exists($id) || $this->dice->getRule($id) != $this->dice->getRule('*'));
    }
}
