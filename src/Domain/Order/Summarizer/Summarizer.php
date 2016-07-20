<?php

namespace Gilbite\OOExercise2\Domain\Order\Summarizer;

use Gilbite\OOExercise2\Domain\Order;
use Gilbite\OOExercise2\Domain\Currency\Currency;

interface Summarizer
{
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

