<?php

namespace Gilbite\OOExercise2\Infrastructure\Order;

use Gilbite\OOExercise2\Domain\Currency\Yen;
use Gilbite\OOExercise2\Domain\Order\Identity;
use Gilbite\OOExercise2\Domain\Order\Order;
use Gilbite\OOExercise2\Domain\Order\Orders;
use Gilbite\OOExercise2\Domain\Order\Repository;

class RdbmsRepository implements Repository
{
    /** @var \PDO */
    private $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * @param \DateTimeImmutable $fromIncluded
     * @param \DateTimeImmutable $toIncluded
     * @return Orders
     */
    public function findBetween(\DateTimeImmutable $fromIncluded, \DateTimeImmutable $toIncluded)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM `order` WHERE placed_at BETWEEN ? AND ?');
        $stmt->execute(
            [$fromIncluded->format('Y-m-d H:i:s'), $toIncluded->format('Y-m-d H:i:s')]
        );

        $tmp = [];
        foreach ($stmt->fetchAll(\PDO::FETCH_ASSOC) as $row) {
            $tmp[] = new Order(
                new Identity($row['id']),
                $row['data'],
                new Yen((int)$row['amount']),
                new \DateTimeImmutable($row['placed_at'])
            );
        }

        return new Orders($tmp);
    }
}

