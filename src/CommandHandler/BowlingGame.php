<?php

namespace Carnage\Bowling\CommandHandler;

use Broadway\CommandHandling\CommandHandler;
use Broadway\Repository\RepositoryInterface;
use Broadway\UuidGenerator\UuidGeneratorInterface;
use Carnage\Bowling\Command\StartGame;
use Carnage\Bowling\Entity\BowlingGame as BowlingGameEntity;

class BowlingGame extends CommandHandler
{
    /**
     * @var \Broadway\Repository\RepositoryInterface
     */
    private $repository;

    /**
     * @var \Broadway\UuidGenerator\UuidGeneratorInterface
     */
    private $uuidGenerator;

    public function __construct(RepositoryInterface $repository, UuidGeneratorInterface $uuidGenerator)
    {
        $this->repository = $repository;
        $this->uuidGenerator = $uuidGenerator;
    }

    protected function handleStartGame(StartGame $command)
    {
        $uuid = $this->uuidGenerator->generate();

        $bowlingGame = BowlingGameEntity::startGame($uuid, $command->getPlayerName());

        $this->repository->save($bowlingGame);
    }
}