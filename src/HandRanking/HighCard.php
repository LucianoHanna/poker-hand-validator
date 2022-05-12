<?php

namespace PokerHandValidator\HandRanking;

use PokerHandValidator\Card;

class HighCard extends HandRanking
{
    public function __construct(private Card $highCard){ }
}