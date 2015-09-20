<?php

namespace Carnage\Bowling\Repository;

use Broadway\EventHandling\EventBusInterface;
use Broadway\EventSourcing\AggregateFactory\PublicConstructorAggregateFactory;
use Broadway\EventSourcing\EventSourcingRepository;
use Broadway\EventStore\EventStoreInterface;
use Carnage\Bowling\Entity\BowlingGame as BowlingGameEntity;

class BowlingGame extends EventSourcingRepository
{
    public function __construct(EventStoreInterface $eventStore, EventBusInterface $eventBus)
    {
        parent::__construct($eventStore, $eventBus, BowlingGameEntity::class, new PublicConstructorAggregateFactory());
    }
}