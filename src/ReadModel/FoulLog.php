<?php

namespace Carnage\Bowling\ReadModel;

use Broadway\ReadModel\ReadModelInterface;

class FoulLog implements ReadModelInterface
{
    const ID = 'foul-recording';

    private $log = [];

    /**
     * @return string
     */
    public function getId()
    {
        return self::ID;
    }

    public function logFoul($pins)
    {
        if (!isset($this->log[$pins])) {
            $this->log[$pins] = 0;
        }

        $this->log[$pins]++;
    }
}
