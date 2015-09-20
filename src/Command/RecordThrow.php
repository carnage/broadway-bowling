<?php

namespace Carnage\Bowling\Command;

/**
 * Class RecordThrow
 * @package Carnage\Bowling\Command
 */
class RecordThrow
{
    private $pins;

    private $isFoul;
    private $bowlingGameId;

    /**
     * @param $bowlingGameId
     * @param $pins
     * @param $isFoul
     */
    public function __construct($bowlingGameId, $pins, $isFoul)
    {
        $this->pins = $pins;
        $this->isFoul = $isFoul;
        $this->bowlingGameId = $bowlingGameId;
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
    public function isFoul()
    {
        return $this->isFoul;
    }

    /**
     * @return mixed
     */
    public function getPins()
    {
        return $this->pins;
    }
}
