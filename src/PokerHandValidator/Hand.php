<?php

namespace PokerHandValidator;


use PokerHandValidator\HandRanking\Flush;
use PokerHandValidator\HandRanking\FourOfAKind;
use PokerHandValidator\HandRanking\FullHouse;
use PokerHandValidator\HandRanking\HandRanking;
use PokerHandValidator\HandRanking\HighCard;
use PokerHandValidator\HandRanking\OnePair;
use PokerHandValidator\HandRanking\RoyalFlush;
use PokerHandValidator\HandRanking\Straight;
use PokerHandValidator\HandRanking\StraightFlush;
use PokerHandValidator\HandRanking\ThreeOfKind;
use PokerHandValidator\HandRanking\TwoPair;

class Hand
{
    /**
     * @var Card[]
     */
    private array $cards;
    private HandRanking $handRanking;

    private array $countsSuit;
    private array $countsCardValue;

    private Card $lowerCard;
    private Card $higherCard;


    /**
     * @param Card[] $cards
     */
    public function __construct(array $cards)
    {
        $this->cards = $cards;
        if (count($this->cards) != 5)
            throw new \InvalidArgumentException('Hand must have 5 cards');

        $this->updateStats();
        $this->handRanking = $this->evaluate();
    }

    public function getHandRanking() : HandRanking {
        return $this->handRanking;
    }

    private function updateStats() : void {
        $this->countsSuit = [];
        $this->countsCardValue = [];
        foreach ($this->cards as $card) {


            $intSuit = $card->getSuit()->suitToInt();
            if (!array_key_exists($intSuit, $this->countsSuit)) $this->countsSuit[$intSuit] = 0;
            $this->countsSuit[$intSuit]++;

            $cardValue = $card->getValue();
            if (!array_key_exists($cardValue, $this->countsCardValue)) $this->countsCardValue[$cardValue] = 0;
            $this->countsCardValue[$cardValue]++;

            if (!isset($this->higherCard)) $this->higherCard = $card;
            if (!isset($this->lowerCard)) $this->lowerCard = $card;

            if (Card::compare($card, $this->higherCard) > 0) $this->higherCard = $card;
            if (Card::compare($card, $this->lowerCard) < 0) $this->lowerCard = $card;
        }
    }

    private function evaluate() : HandRanking {

        $flush = $this->isFlush();
        $straight = $this->isStraight();

        if ($flush !== null) {
            if ($straight) {
                if ($this->higherCard->getValue() === 0)
                    return new RoyalFlush($this->lowerCard, $this->higherCard, Suit::intToSuit($flush));
                return new StraightFlush($this->lowerCard, $this->higherCard, Suit::intToSuit($flush));
            }
            return new Flush(Suit::intToSuit($flush));
        }
        if ($straight)
            return new Straight($this->lowerCard, $this->higherCard);


        $threeOfAKind = null;
        $pairs = [];
        // cache count of pairs
        $countPairs = 0;
        foreach ($this->countsCardValue as $value => $count) {
            if ($count === 4) return new FourOfAKind($value);
            elseif ($count === 3) $threeOfAKind = $value;
            elseif ($count === 2) { $pairs[] = $value; $countPairs++;}

            if ($threeOfAKind !== null && $countPairs === 1) return new FullHouse($threeOfAKind, $pairs[0]);
        }
        if ($threeOfAKind !== null) return new ThreeOfKind($threeOfAKind);

        if ($countPairs === 2) return new TwoPair($pairs[0], $pairs[1]);
        if ($countPairs === 1) return new OnePair($pairs[0]);

        return new HighCard($this->higherCard);

    }

    private function isFlush() : ?int {
        foreach ($this->countsSuit as $suit => $count) {
            if ($count === 5) {
                return $suit;
            }
        }
        return null;
    }

    private function isStraight() : bool
    {
        // Ace special cases
        if ($this->higherCard->getValue() === 0) {

            // 10 J Q K A
            if ($this->lowerCard->getValue() === 9)
                return true;

            // A 2 3 4 5
            for ($i = 0; $i <= 4; $i++) {
                if (!array_key_exists($i, $this->countsCardValue) || $this->countsCardValue[$i] !== 1) return false;
            }
            return true;
        }
        if ($this->higherCard->getValue() - $this->lowerCard->getValue() > 4) return false;

        for ($i = $this->lowerCard->getValue(); $i <= $this->higherCard->getValue(); $i++) {
            if (!array_key_exists($i, $this->countsCardValue) || $this->countsCardValue[$i] !== 1) return false;
        }

        return true;
    }

}