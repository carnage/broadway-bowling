<?php

namespace Carnage\Bowling\Event;

class ThrowRecorded
{
    private $bowlingGameId;

    private $pins;

    private $isFoul;

    private $frame;

    private $throw;

    public function __construct($gameId, $frame, $throw, $pins, $isFoul)
    {
        $this->bowlingGameId = $gameId;
        $this->pins = $pins;
        $this->isFoul = $isFoul;
        $this->frame = $frame;
        $this->throw = $throw;
    }

    /**
     * @return mixed
     */
    public function getBowlingGameId()
    {
        return $this->bowlingGameId;
    }

    /**
     * @return mixed
     */
    public function getPins()
    {
        return $this->pins;
    }

    /**
     * @return mixed
     */
    public function isFoul()
    {
        return $this->isFoul;
    }

    /**
     * @return mixed
     */
    public function getFrame()
    {
        return $this->frame;
    }

    /**
     * @return mixed
     */
    public function getThrow()
    {
        return $this->throw;
    }
}