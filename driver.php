<?php
include_once 'vendor/autoload.php';

$commandBus = new \Broadway\CommandHandling\SimpleCommandBus();

$inMemoryEventStore = new Broadway\EventStore\InMemoryEventStore();
$eventBus = new \Broadway\EventHandling\SimpleEventBus();

$repository = new Carnage\Bowling\Repository\BowlingGame($inMemoryEventStore, $eventBus);
$uuidGenerator = new Broadway\UuidGenerator\Rfc4122\Version4Generator();

$handler = new Carnage\Bowling\CommandHandler\BowlingGame($repository, $uuidGenerator);

$commandBus->subscribe($handler);