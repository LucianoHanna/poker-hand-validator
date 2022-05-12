<?php

namespace PokerHandValidator\HandRanking;

use PokerHandValidator\Card;
use PokerHandValidator\Suit;

class StraightFlush extends HandRanking
{

    public function __construct(private Card $minValue, private Card $maxValue, private Suit $suit)
    {
    }
}