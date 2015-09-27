<?php

namespace Carnage\Bowling\ReadModel;

use Broadway\ReadModel\ReadModelInterface;

class Scoreboard implements ReadModelInterface
{
    private $playerName;
    private $id;
    /**
     * @var Frame[]
     */
    private $frames;

    public static function create($id, $playerName)
    {
        $scoreboard = new self;
        $scoreboard->id = $id;
        $scoreboard->playerName = $playerName;

        return $scoreboard;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getPlayerName()
    {
        return $this->playerName;
    }

    public function updateScore($frame, $throw, $pins, $isFoul)
    {
        $score = $isFoul ? 0 : $pins;

        if (!isset($this->frames[$frame])) {
            $this->frames[$frame] = new Frame();
        }

        $this->frames[$frame]->recordThrow($throw, $score);

        if (isset($this->frames[$frame - 1])) {
            $this->frames[$frame - 1]->recordBonus($score);
        }

        if (isset($this->frames[$frame - 2])) {
            $this->frames[$frame - 2]->recordBonus($score);
        }
    }

    public function getScoreboard()
    {
        $scoreboard = [];
        $totalScore = 0;

        foreach ($this->frames as $f => $frame) {
            $scoreboard[$f] = $frame->getScore();
            $totalScore += $scoreboard[$f]['score'];
        }

        return ['totalScore' =>  $totalScore, 'frames' => $scoreboard];
    }
}
