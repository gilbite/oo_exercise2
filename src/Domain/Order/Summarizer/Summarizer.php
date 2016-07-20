<?php

namespace Gilbite\OOExercise2\Domain\Order\Summarizer;

use Gilbite\OOExercise2\Domain\Order;
use Gilbite\OOExercise2\Domain\Currency\Currency;

interface Summarizer
{
    /**
     * @param Order\Identity $id
     * @param $otherData
     * @param Currency $amount
     * @param \DateTimeImmutable $placedAt
     * @return mixed
     */
    public function select(Order\Identity $id, $otherData, Currency $amount, \DateTimeImmutable $placedAt);
    
    /**
     * @param Order\Order $order
     * @return void
     */
    public function evaluate(Order\Order $order);

    /**
     * @return mixed
     */
    public function result();
}

