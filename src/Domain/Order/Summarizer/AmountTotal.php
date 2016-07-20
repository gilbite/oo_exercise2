<?php

namespace Gilbite\OOExercise2\Domain\Order\Summarizer;

use Gilbite\OOExercise2\Domain\Currency\Currency;
use Gilbite\OOExercise2\Domain\Order;

class AmountTotal implements Summarizer
{
    /** @var Currency */
    protected $total;

    public function evaluate(Order\Order $order)
    {
        $amount = $order->amount();

        $this->total = $this->total ? $this->total->add($amount) : $amount;
    }

    /**
     * @return Currency|null
     */
    public function result()
    {
        return $this->total;
    }
}

