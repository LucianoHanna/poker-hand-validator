<?php

namespace PokerHandValidator\HandRanking;

use PokerHandValidator\Suit;

class Flush extends HandRanking
{
    public function __construct(private Suit $suit)
    {
    }
}