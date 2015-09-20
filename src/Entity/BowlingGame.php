<?php

namespace Carnage\Bowling\Entity;

use Broadway\EventSourcing\EventSourcedAggregateRoot;
use Carnage\Bowling\Event\GameStarted;
use Carnage\Bowling\Event\ThrowRecorded;

class BowlingGame extends EventSourcedAggregateRoot
{
    private $id;
    private $playerName;

    private $frameCount = 0;
    private $currentFramePins = 0;
    private $currentFrameThrowsRemaining = 2;

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

    public function recordThrow($pins, $isFoul)
    {
        if ($pins < 0) {
            throw new \UnexpectedValueException('Pins must be greater than 0');
        }

        if ($pins > 10) {
            throw new \UnexpectedValueException('Pins must be 10 or less');
        }

        if ($pins + $this->currentFramePins > 10) {
            throw new \UnexpectedValueException('Total frame pins must not exceed 10');
        }

        if ($this->currentFrameThrowsRemaining < 1 && $this->frameCount >= 12) {
            throw new \RuntimeException('Game has finished');
        }

        $currentFrame = ($this->currentFrameThrowsRemaining === 0) ? $this->frameCount + 1 : $this->frameCount;
        $throw = 2 - $this->currentFrameThrowsRemaining;

        $this->apply(new ThrowRecorded($this->id, $currentFrame, $throw, $pins, $isFoul));
    }

    protected  function applyScoreRecorded(ThrowRecorded $event)
    {
        $this->currentFrameThrowsRemaining--;
        $this->currentFramePins += $event->isFoul() ? 0 : $event->getPins();

        if ($this->currentFrameThrowsRemaining === 0 || $this->currentFramePins === 10) {
            $this->frameCount++;
            $this->currentFrameThrowsRemaining = 2;
            $this->currentFramePins = 0;
        }
    }
}