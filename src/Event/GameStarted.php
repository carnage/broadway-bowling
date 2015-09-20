<?php

namespace Carnage\Bowling\Event;

/**
 * Class GameStarted
 * @package Carnage\Bowling\Event
 */
class GameStarted
{
    /**
     * @var string
     */
    private $uuid;

    /**
     * @var string
     */
    private $playerName;

    /**
     * @param string $uuid
     * @param string $playerName
     */
    public function __construct($uuid, $playerName)
    {
        $this->playerName = $playerName;
        $this->uuid = $uuid;
    }

    /**
     * @return string
     */
    public function getPlayerName()
    {
        return $this->playerName;
    }

    /**
     * @return string
     */
    public function getUuid()
    {
        return $this->uuid;
    }
}
