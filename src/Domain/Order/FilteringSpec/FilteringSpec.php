<?php

namespace Gilbite\OOExercise2\Domain\Order\FilteringSpec;

use Gilbite\OOExercise2\Domain\Order\Order;
use Gilbite\OOExercise2\Domain\Order\Orders;
use Gilbite\OOExercise2\Domain\Order\Repository;

interface FilteringSpec
{
    /**
     * @param Order $order
     * @return bool
     */
    public function isSatisfiedBy(Order $order);

    /**
     * @param Repository $repository
     * @return Orders
     */
    public function satisfyingOrdersFrom(Repository $repository);
}
