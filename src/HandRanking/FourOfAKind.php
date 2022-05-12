<?php

namespace PokerHandValidator\HandRanking;

class FourOfAKind extends HandRanking
{
    public function __construct(private int $value)
    {
    }
}