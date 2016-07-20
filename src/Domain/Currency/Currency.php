<?php

namespace Gilbite\OOExercise2\Domain\Currency;

interface Currency
{
    /**
     * @param Currency $currency
     * @return Currency
     */
    public function add(Currency $currency);

    /**
     * @return string
     */
    public function __invoke();
}

