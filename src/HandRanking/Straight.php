<?php

namespace PokerHandValidator\HandRanking;

use PokerHandValidator\Card;

class Straight extends HandRanking
{
    public function __construct(private Card $minValue, private Card $maxValue)
    {
    }
}