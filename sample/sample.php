<?php
error_reporting(E_ALL);
ini_set('date.timezone', 'Asia/Tokyo');

require_once __DIR__ . '/../autoload.php';

use Gilbite\OOExercise2\Application\Order\Summarize;
use Gilbite\OOExercise2\Domain\Currency\Yen;
use Gilbite\OOExercise2\Infrastructure\Order\RdbmsRepository;
use Gilbite\OOExercise2\Domain\Order\Order;
use Gilbite\OOExercise2\Domain\Order\Orders;
use Gilbite\OOExercise2\Domain\Order\Identity;
use Gilbite\OOExercise2\Domain\Order\FilteringSpec\PlacedAtBetween;
use Gilbite\OOExercise2\Domain\Order\Summarizer\AmountTotal;

// service with resolving dependencies
$pdo = new \PDO('sqlite:' . __DIR__ . '/sample.sqlite');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$repo    = new RdbmsRepository($pdo);
$usecase = new Summarize($repo);

/*
$pdo->exec('DROP TABLE IF EXISTS "order"');
$pdo->exec('
 CREATE TABLE IF NOT EXISTS "order"
(
    id TEXT PRIMARY KEY NOT NULL,
    data TEXT NOT NULL,
    amount int NOT NULL,
    placed_at DATETIME_INTERVAL_CODE NOT NULL
)');
$pdo->exec('DELETE FROM "order"');
$pdo->exec('INSERT INTO "order" VALUES ("hoge", "data1", 123, "2016-07-20 15:23:34")');
$pdo->exec('INSERT INTO "order" VALUES ("fooo", "data2", 234, "2016-07-20 16:00:01")');
$pdo->exec('INSERT INTO "order" VALUES ("barr", "data3", 345, "2016-07-21 21:12:30")');
*/

echo '---- with db' . PHP_EOL;
var_dump($usecase->sumAmount('2016-07-20 16:00:01', '2016-07-20 16:00:01'));
var_dump($usecase->sumAmount('2016-07-20 15:23:34', '2016-07-20 16:00:01'));
var_dump($usecase->sumAmount('2016-07-20 15:23:34', '2016-07-21 21:12:30'));

echo PHP_EOL;
echo '---- with raw' . PHP_EOL;

$orders = new Orders([
    new Order(new Identity('hoge'), 'data1', new Yen(123), new \DateTimeImmutable('2016-07-20 15:23:34')),
    new Order(new Identity('fooo'), 'data2', new Yen(234), new \DateTimeImmutable('2016-07-20 16:00:01')),
    new Order(new Identity('barr'), 'data3', new Yen(345), new \DateTimeImmutable('2016-07-21 21:12:30')),
]);

function placedAt($startAt, $endAt) {
    return new PlacedAtBetween(new DateTimeImmutable($startAt), new DateTimeImmutable($endAt));
};

var_dump($orders->select(placedAt('2016-07-20 16:00:01', '2016-07-20 16:00:01'))->summarize(new AmountTotal()));
var_dump($orders->select(placedAt('2016-07-20 15:23:34', '2016-07-20 16:00:01'))->summarize(new AmountTotal()));
var_dump($orders->select(placedAt('2016-07-20 15:23:34', '2016-07-21 21:12:30'))->summarize(new AmountTotal()));

