<?php

namespace Gilbite\OOExercise2\Domain\Order;

class Identity
{
    private $idAsString;

    public function __construct($idAsString)
    {
        // todo guard

        $this->idAsString = $idAsString;
    }
}

