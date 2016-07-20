<?php

namespace Gilbite\OOExercise2\Domain\Order\Summarizer;

use Gilbite\OOExercise2\Domain\Currency\Currency;
use Gilbite\OOExercise2\Domain\Order;

class AmountTotal implements Summarizer
{
    /** @var Currency */
    protected $total;


    public function select(Order\Identity $id, $otherData, Currency $amount, \DateTimeImmutable $placedAt)
    {
        return $amount;
    }

    public function evaluate(Order\Order $order)
    {
        $amount = $order->expose($this);

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

