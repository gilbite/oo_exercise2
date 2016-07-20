<?php

namespace Gilbite\OOExercise2\Application\Order;

use Gilbite\OOExercise2\Domain\Order\FilteringSpec\PlacedAtBetween;
use Gilbite\OOExercise2\Domain\Order\Repository;
use Gilbite\OOExercise2\Domain\Order\Summarizer\AmountTotal;

class Summarize
{
    /** @var Repository */
    private $orderRepository;

    public function __construct(Repository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function sumAmount($from, $to)
    {
        $range    = new PlacedAtBetween(new \DateTimeImmutable($from), new \DateTimeImmutable($to));
        $orders   = $range->satisfyingOrdersFrom($this->orderRepository);
        $currency = $orders->summarize(new AmountTotal());

        return $currency();
    }
}

