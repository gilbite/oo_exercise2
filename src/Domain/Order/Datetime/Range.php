<?php

namespace Gilbite\OOExercise2\Domain\Order\Datetime;

use Gilbite\OOExercise2\Domain\Order\Repository;
use Gilbite\OOExercise2\Domain\Order\Orders;

class Range
{
    /** @var \DateTimeImmutable */
    private $startAt;
    /** @var \DateTimeImmutable */
    private $endAt;

    /**
     * @param \DateTimeImmutable $statAt
     * @param \DateTimeImmutable $endAt
     */
    public function __construct(\DateTimeImmutable $statAt, \DateTimeImmutable $endAt)
    {
        if ($statAt > $endAt) {
            throw new \DomainException('should be startAt <= endAt');
        }

        $this->startAt = $statAt;
        $this->endAt   = $endAt;
    }
/*
    public function contains(\DateTimeImmutable $someTime)
    {
        return
            ($this->startAt <= $someTime)
            && ($someTime <= $this->endAt);
    }
*/
    /**
     * @param Repository $repository
     * @return Orders
     */
    public function satisfyingOrdersFrom(Repository $repository)
    {
        return $repository->findBetween($this->startAt, $this->endAt);
    }
}

