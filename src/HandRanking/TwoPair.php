<?php

namespace PokerHandValidator\HandRanking;

class TwoPair extends HandRanking
{
    public function __construct(private int $firstPair, private int $secondPair){ }
}