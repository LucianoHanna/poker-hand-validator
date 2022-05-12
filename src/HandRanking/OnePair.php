<?php

namespace PokerHandValidator\HandRanking;

class OnePair extends HandRanking
{
    public function __construct(private int $pair){ }
}