<?php

namespace PokerHandValidator\HandRanking;

class ThreeOfKind extends HandRanking
{
    public function __construct(private int $threeOfKind){ }
}