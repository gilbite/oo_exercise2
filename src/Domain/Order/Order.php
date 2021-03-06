<?php

namespace Gilbite\OOExercise2\Domain\Order;

use Gilbite\OOExercise2\Domain\Currency\Currency;
use Gilbite\OOExercise2\Domain\Order\Summarizer\Summarizer;

class Order
{
    /** @var Identity */
    private $identity;
    /** @var mixed */
    private $data;
    /** @var \DateTimeImmutable */
    private $placedAt;
    /** @var Currency */
    private $amount;

    public function __construct(Identity $identity, $data, Currency $amount, \DateTimeImmutable $placedAt)
    {
        $this->identity = $identity;
        $this->data     = $data;
        $this->amount   = $amount;
        $this->placedAt = $placedAt;
    }

    public function amount()
    {
        return $this->amount;
    }

    public function placedAt()
    {
        return $this->placedAt;
    }
}

