<?php

namespace PokerHandValidator;

class Card
{
    private int $value;

    public function __construct(
        private Suit $suit,
        int $value
    ) {
        if ($value < 0 || $value > 12)
            throw new \InvalidArgumentException('Card value invalid');

        $this->value = $value;
    }

    public function getSuit() : Suit {
        return $this->suit;
    }

    public function getValue() : int {
        return $this->value;
    }

    public static function compare(Card $a, Card $b) : int {
        if ($a->getValue() === $b->getValue()) return 0;
        if ($b->getValue() === 0) return -1;
        if ($a->getValue() === 0 || $a->getValue() > $b->getValue()) return 1;
        return -1;
    }
}