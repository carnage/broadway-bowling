<?php

namespace Carnage\Bowling\ReadModel;

class Frame
{
    private $throw0;
    private $throw1;

    private $bonus0;
    private $bonus1;

    private function isOpen()
    {
        return !($this->throw0 === 10 && $this->throw1 !== null);
    }

    /**
     * @return bool
     */
    private function hasBonus0()
    {
        return $this->bonus0 === null && (($this->throw0 + $this->throw1) === 10);
    }

    /**
     * @return bool
     */
    private function hasBonus1()
    {
        return $this->bonus1 === null && $this->throw0 === 10;
    }

    public function recordThrow($number, $score)
    {
        if ($number === 0) {
            $this->throw0 = $score;
            if ($score === 10) {
                $this->throw1 = 0;
            }
        } elseif ($number === 1) {
            $this->throw1 = $score;
        }
    }

    public function recordBonus($score)
    {
        if ($this->hasBonus0()) {
            $this->bonus0 = $score;
        } elseif ($this->hasBonus1()) {
            $this->bonus1 = $score;
        }
    }

    public function getScore()
    {
        $score = null;
        if (!($this->hasBonus0() || $this->hasBonus1() || $this->isOpen())) {
            $score = $this->throw0 + $this->throw1 + $this->bonus0 + $this->bonus1;
        }

        return [
            'throw0' => $this->throw0,
            'throw1' => $this->throw1,
            'score'  => $score
        ];
    }
}
