<?php

namespace Carnage\Bowling\Projection;

use Broadway\ReadModel\Projector;
use Broadway\ReadModel\RepositoryInterface;
use Carnage\Bowling\Event\GameStarted;
use Carnage\Bowling\Event\ThrowRecorded;
use Carnage\Bowling\ReadModel\Scoreboard as ScoreboardReadModel;

class Scoreboard extends Projector
{
    /**
     * @var \Broadway\ReadModel\RepositoryInterface
     */
    private $repository;

    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    protected function applyGameStarted(GameStarted $event)
    {
        $game = ScoreboardReadModel::create($event->getUuid(), $event->getPlayerName());
        $this->repository->save($game);
    }

    protected function applyThrowRecorded(ThrowRecorded $event)
    {
        /** @var ScoreboardReadModel $game */
        $game = $this->repository->find($event->getBowlingGameId());

        $game->updateScore($event->getFrame(), $event->getThrow(), $event->getPins(), $event->isFoul());

        $this->repository->save($game);
    }
}