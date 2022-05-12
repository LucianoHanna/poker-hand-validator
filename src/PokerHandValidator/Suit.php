<?php

namespace PokerHandValidator;

enum SuitType {
    case Clubs;
    case Diamonds;
    case Hearts;
    case Spades;
}

class Suit {
    public function __construct(private SuitType $type)
    {
    }

    /**
     * Function to discretize value so can use it as array key
     * @return int
     */
    public function suitToInt() : int
    {
        switch ($this->type) {
            case SuitType::Clubs: return 0;
            case SuitType::Diamonds: return 1;
            case SuitType::Hearts: return 2;
            case SuitType::Spades: return 3;
        }

        throw new \UnexpectedValueException();
    }

    public static function intToSuit($int) : Suit
    {
        switch ($int) {
            case 0: return new Suit(SuitType::Clubs);
            case 1: return new Suit(SuitType::Diamonds);
            case 2: return new Suit(SuitType::Hearts);
            case 3: return new Suit(SuitType::Spades);
        }
        throw new \UnexpectedValueException();
    }
}

