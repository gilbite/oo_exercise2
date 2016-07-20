<?php
error_reporting(E_ALL);
ini_set('date.timezone', 'Asia/Tokyo');

require_once __DIR__ . '/../autoload.php';

use \Gilbite\OOExercise2\Application\Order\Summarize;
use \Gilbite\OOExercise2\Infrastructure\Order\RdbmsRepository;

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


var_dump($usecase->sumAmount('2016-07-20 16:00:01', '2016-07-20 16:00:01'));
var_dump($usecase->sumAmount('2016-07-20 15:23:34', '2016-07-20 16:00:01'));
var_dump($usecase->sumAmount('2016-07-20 15:23:34', '2016-07-21 21:12:30'));
