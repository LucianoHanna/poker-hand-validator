<?php

namespace PokerHandValidator\HandRanking;

class FullHouse extends HandRanking
{
    public function __construct(private int $threeOfKind, private int $pair){ }
}