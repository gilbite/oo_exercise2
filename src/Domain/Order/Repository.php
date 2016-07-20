<?php

namespace Gilbite\OOExercise2\Domain\Order;

interface Repository
{
    /**
     * @param \DateTimeImmutable $fromIncluded
     * @param \DateTimeImmutable $toIncluded
     * @return Orders
     */
    public function findBetween(\DateTimeImmutable $fromIncluded, \DateTimeImmutable $toIncluded);
}
