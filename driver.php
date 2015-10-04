<?php
include_once 'vendor/autoload.php';

$commandBus = new \Broadway\CommandHandling\SimpleCommandBus();

$inMemoryEventStore = new \Broadway\EventStore\InMemoryEventStore();
$eventBus = new \Broadway\EventHandling\SimpleEventBus();

$repository = new \Carnage\Bowling\Repository\BowlingGame($inMemoryEventStore, $eventBus);
$uuidGenerator = new \Broadway\UuidGenerator\Rfc4122\Version4Generator();

$handler = new \Carnage\Bowling\CommandHandler\BowlingGame($repository, $uuidGenerator);

$commandBus->subscribe($handler);

$readRepository = new \Broadway\ReadModel\InMemory\InMemoryRepository();

$projection = new \Carnage\Bowling\Projection\Scoreboard($readRepository);

$eventBus->subscribe($projection);

class Listener extends \Broadway\ReadModel\Projector
{
    public function __construct()
    {

    }

    public function applyGameStarted(\Carnage\Bowling\Event\GameStarted $event)
    {
        echo $event->getPlayerName() . "\n";
        echo $event->getUuid();
    }
}

$eventBus->subscribe(new Listener());
$command = new \Carnage\Bowling\Command\StartGame('Carnage');//, new \Carnage\Bowling\Command\RecordThrow()
$commandBus->dispatch($command);

