<?php

namespace Gilbite\OOExercise2\Domain\Order;

use Gilbite\OOExercise2\Domain\Order\FilteringSpec\FilteringSpec;
use Gilbite\OOExercise2\Domain\Order\Summarizer\Summarizer;

class Orders
{
    protected $orders = [];

    public function __construct(array $orders)
    {
        foreach ($orders as $order) {
            if (!is_object($order) || !($order instanceof Order)) {
                throw new \InvalidArgumentException('expected Order object.');
            }

            $this->orders[] = $order;
        }
    }

    public function summarize(Summarizer $summarizer)
    {
        foreach ($this->orders as $order) {
            $summarizer->evaluate($order);
        }

        return $summarizer->result();
    }

    public function select(FilteringSpec $spec)
    {
        $tmp = [];
        foreach ($this->orders as $order) {
            if ($spec->isSatisfiedBy($order)) {
                $tmp[] = $order;
            }
        }

        return new static($tmp);
    }
}

