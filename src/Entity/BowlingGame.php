<?php

namespace Carnage\Bowling\Entity;

use Broadway\EventSourcing\EventSourcedAggregateRoot;
use Carnage\Bowling\Event\GameStarted;

class BowlingGame extends EventSourcedAggregateRoot
{
    private $id;
    private $playerName;

    /**
     * @return string
     */
    public function getAggregateRootId()
    {
        return $this->id;
    }

    public static function startGame($uuid, $playerName)
    {
        $game = new self();

        $game->apply(new GameStarted($uuid, $playerName));

        return $game;
    }

    protected function applyGameStarted(GameStarted $event)
    {
        $this->id = $event->getUuid();
        $this->playerName = $event->getPlayerName();
    }
}