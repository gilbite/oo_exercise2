<?php

namespace Gilbite\OOExercise2\Domain\Order\FilteringSpec;

use Gilbite\OOExercise2\Domain\Order\Order;
use Gilbite\OOExercise2\Domain\Order\Repository;

class PlacedAtBetween implements FilteringSpec
{
    /** @var \DateTimeImmutable */
    private $startAt;
    /** @var \DateTimeImmutable */
    private $endAt;

    public function __construct(\DateTimeImmutable $startAt, \DateTimeImmutable $endAt)
    {
        $this->startAt = $startAt;
        $this->endAt = $endAt;
    }

    public function isSatisfiedBy(Order $order)
    {
        return
            ($this->startAt <= $order->placedAt())
            && ($order->placedAt() <= $this->endAt);
    }

    public function satisfyingOrdersFrom(Repository $repository)
    {
        return $repository->findBetween($this->startAt, $this->endAt);
    }
}

