<?php

use PHPUnit\Framework\TestCase;
use PokerHandValidator\Card;
use PokerHandValidator\Hand;
use PokerHandValidator\HandRanking\RoyalFlush;
use PokerHandValidator\HandRanking\Straight;
use PokerHandValidator\HandRanking\StraightFlush;
use PokerHandValidator\Suit;
use PokerHandValidator\SuitType;

final class CardTest extends TestCase
{

    public function testAceIsHigherThan2() : void {
        $this->assertEquals(1,
            Card::compare(
                new Card(new Suit(SuitType::Diamonds), 0),
                new Card(new Suit(SuitType::Diamonds), 1)
            ));
    }

    public function test2IsLowerThan3() : void {
        $this->assertEquals(-1,
            Card::compare(
                new Card(new Suit(SuitType::Diamonds), 2),
                new Card(new Suit(SuitType::Diamonds), 3)
            ));
    }

    public function test2IsEqual2() : void {
        $this->assertEquals(0,
            Card::compare(
                new Card(new Suit(SuitType::Diamonds), 2),
                new Card(new Suit(SuitType::Diamonds), 2)
            ));
    }

    public function test2IsLowerThanAce() : void {
        $this->assertEquals(-1,
            Card::compare(
                new Card(new Suit(SuitType::Diamonds), 2),
                new Card(new Suit(SuitType::Diamonds), 0)
            ));
    }

    public function testCannotCreateCardWithInvalidLowValue() : void {
        $this->expectException(InvalidArgumentException::class);

        $card = new Card(new Suit(SuitType::Diamonds), -1);
    }

    public function testCannotCreateCardWithInvalidHighValue() : void {
        $this->expectException(InvalidArgumentException::class);

        $card = new Card(new Suit(SuitType::Diamonds), 20);
    }

}