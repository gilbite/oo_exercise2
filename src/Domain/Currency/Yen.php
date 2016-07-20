<?php

namespace Gilbite\OOExercise2\Domain\Currency;

final class Yen implements Currency
{
    private $yenAsInteger;

    public function __construct($yenAsInteger)
    {
        if (!is_int($yenAsInteger) || $yenAsInteger < 0) {
            throw new \InvalidArgumentException('please give me integer');
        }

        $this->yenAsInteger = $yenAsInteger;
    }

    public function add(Currency $other)
    {
        /** @var Yen $other */
        if (!($other instanceof self)) {
            throw new \InvalidArgumentException('expected Yen');
        }

        return new static($this->yenAsInteger + $other->yenAsInteger);
    }

    public function __invoke()
    {
        return sprintf('%d JPY', $this->yenAsInteger);
    }
}

