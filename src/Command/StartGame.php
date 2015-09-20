<?php

namespace Carnage\Bowling\Command;

/**
 * Class StartGame
 * @package Carnage\Bowling\Command
 */
class StartGame
{
    /**
     * @var string
     */
    private $playerName;

    /**
     * @param string $playerName
     */
    public function __construct($playerName)
    {
        $this->playerName = $playerName;
    }

    /**
     * @return string
     */
    public function getPlayerName()
    {
        return $this->playerName;
    }
}
