<?php

namespace Carnage\Bowling\Projection;

use Broadway\ReadModel\Projector;
use Broadway\ReadModel\RepositoryInterface;
use Carnage\Bowling\Event\ThrowRecorded;
use Carnage\Bowling\ReadModel\FoulLog;

class Fouls extends Projector
{
    /**
     * @var \Broadway\ReadModel\RepositoryInterface
     */
    private $repository;

    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    protected function handleThrowRecorded(ThrowRecorded $event)
    {
        if ($event->getThrow() === 0 && $event->isFoul()) {
            /** @var FoulLog $model */
            $model = $this->repository->find(FoulLog::ID);
            $model->logFoul($event->getPins());
            $this->repository->save($model);
        }
    }
}