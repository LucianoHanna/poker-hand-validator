<?php

use PHPUnit\Framework\TestCase;
use PokerHandValidator\Card;
use PokerHandValidator\Hand;
use PokerHandValidator\HandRanking\FourOfAKind;
use PokerHandValidator\HandRanking\FullHouse;
use PokerHandValidator\HandRanking\HighCard;
use PokerHandValidator\HandRanking\OnePair;
use PokerHandValidator\HandRanking\RoyalFlush;
use PokerHandValidator\HandRanking\Straight;
use PokerHandValidator\HandRanking\StraightFlush;
use PokerHandValidator\HandRanking\ThreeOfKind;
use PokerHandValidator\HandRanking\TwoPair;
use PokerHandValidator\Suit;

final class HandTest extends TestCase
{

    public function testHighCard() : void {
        $hand = new Hand([
            new Card(new Suit(\PokerHandValidator\SuitType::Spades), 0),
            new Card(new Suit(\PokerHandValidator\SuitType::Diamonds), 2),
            new Card(new Suit(\PokerHandValidator\SuitType::Clubs), 3),
            new Card(new Suit(\PokerHandValidator\SuitType::Hearts), 5),
            new Card(new Suit(\PokerHandValidator\SuitType::Diamonds), 4),
        ]);

        $this->assertInstanceOf(HighCard::class, $hand->getHandRanking());
    }

    public function testOnePair() : void {
        $hand = new Hand([
            new Card(new Suit(\PokerHandValidator\SuitType::Spades), 0),
            new Card(new Suit(\PokerHandValidator\SuitType::Diamonds), 0),
            new Card(new Suit(\PokerHandValidator\SuitType::Clubs), 3),
            new Card(new Suit(\PokerHandValidator\SuitType::Hearts), 5),
            new Card(new Suit(\PokerHandValidator\SuitType::Diamonds), 4),
        ]);

        $this->assertInstanceOf(OnePair::class, $hand->getHandRanking());
    }

    public function testTwoPair() : void {
        $hand = new Hand([
            new Card(new Suit(\PokerHandValidator\SuitType::Spades), 0),
            new Card(new Suit(\PokerHandValidator\SuitType::Diamonds), 0),
            new Card(new Suit(\PokerHandValidator\SuitType::Clubs), 5),
            new Card(new Suit(\PokerHandValidator\SuitType::Hearts), 5),
            new Card(new Suit(\PokerHandValidator\SuitType::Diamonds), 4),
        ]);

        $this->assertInstanceOf(TwoPair::class, $hand->getHandRanking());
    }

    public function testAceThreeOfKind() : void {
        $hand = new Hand([
            new Card(new Suit(\PokerHandValidator\SuitType::Spades), 0),
            new Card(new Suit(\PokerHandValidator\SuitType::Diamonds), 0),
            new Card(new Suit(\PokerHandValidator\SuitType::Clubs), 0),
            new Card(new Suit(\PokerHandValidator\SuitType::Hearts), 5),
            new Card(new Suit(\PokerHandValidator\SuitType::Diamonds), 4),
        ]);

        $this->assertInstanceOf(ThreeOfKind::class, $hand->getHandRanking());
    }

    public function testThreeOfKind() : void {
        $hand = new Hand([
            new Card(new Suit(\PokerHandValidator\SuitType::Spades), 1),
            new Card(new Suit(\PokerHandValidator\SuitType::Diamonds), 1),
            new Card(new Suit(\PokerHandValidator\SuitType::Clubs), 1),
            new Card(new Suit(\PokerHandValidator\SuitType::Hearts), 5),
            new Card(new Suit(\PokerHandValidator\SuitType::Diamonds), 4),
        ]);

        $this->assertInstanceOf(ThreeOfKind::class, $hand->getHandRanking());
    }

    public function testFullHouse() : void {
        $hand = new Hand([
            new Card(new Suit(\PokerHandValidator\SuitType::Spades), 0),
            new Card(new Suit(\PokerHandValidator\SuitType::Diamonds), 0),
            new Card(new Suit(\PokerHandValidator\SuitType::Clubs), 0),
            new Card(new Suit(\PokerHandValidator\SuitType::Hearts), 4),
            new Card(new Suit(\PokerHandValidator\SuitType::Diamonds), 4),
        ]);

        $this->assertInstanceOf(FullHouse::class, $hand->getHandRanking());
    }

    public function testFourOfAKind() : void {
        $hand = new Hand([
            new Card(new Suit(\PokerHandValidator\SuitType::Spades), 0),
            new Card(new Suit(\PokerHandValidator\SuitType::Diamonds), 0),
            new Card(new Suit(\PokerHandValidator\SuitType::Clubs), 0),
            new Card(new Suit(\PokerHandValidator\SuitType::Hearts), 0),
            new Card(new Suit(\PokerHandValidator\SuitType::Diamonds), 4),
        ]);

        $this->assertInstanceOf(FourOfAKind::class, $hand->getHandRanking());
    }

    public function testStraightAceTo5() : void {
        $hand = new Hand([
            new Card(new Suit(\PokerHandValidator\SuitType::Spades), 0),
            new Card(new Suit(\PokerHandValidator\SuitType::Diamonds), 1),
            new Card(new Suit(\PokerHandValidator\SuitType::Diamonds), 2),
            new Card(new Suit(\PokerHandValidator\SuitType::Diamonds), 3),
            new Card(new Suit(\PokerHandValidator\SuitType::Diamonds), 4),
        ]);

        $this->assertInstanceOf(Straight::class, $hand->getHandRanking());
    }

    public function testStraight10ToAce() : void {
        $hand = new Hand([
            new Card(new Suit(\PokerHandValidator\SuitType::Spades), 0),
            new Card(new Suit(\PokerHandValidator\SuitType::Diamonds), 12),
            new Card(new Suit(\PokerHandValidator\SuitType::Diamonds), 11),
            new Card(new Suit(\PokerHandValidator\SuitType::Diamonds), 10),
            new Card(new Suit(\PokerHandValidator\SuitType::Diamonds), 9),
        ]);

        $this->assertInstanceOf(Straight::class, $hand->getHandRanking());
    }

    public function testStraightFlushAceTo5() : void {
        $hand = new Hand([
            new Card(new Suit(\PokerHandValidator\SuitType::Diamonds), 0),
            new Card(new Suit(\PokerHandValidator\SuitType::Diamonds), 1),
            new Card(new Suit(\PokerHandValidator\SuitType::Diamonds), 2),
            new Card(new Suit(\PokerHandValidator\SuitType::Diamonds), 3),
            new Card(new Suit(\PokerHandValidator\SuitType::Diamonds), 4),
        ]);

        $this->assertInstanceOf(StraightFlush::class, $hand->getHandRanking());
    }

    public function testStraightWithoutAce() : void {
        $hand = new Hand([
            new Card(new Suit(\PokerHandValidator\SuitType::Diamonds), 1),
            new Card(new Suit(\PokerHandValidator\SuitType::Diamonds), 2),
            new Card(new Suit(\PokerHandValidator\SuitType::Diamonds), 3),
            new Card(new Suit(\PokerHandValidator\SuitType::Diamonds), 4),
            new Card(new Suit(\PokerHandValidator\SuitType::Spades), 5),
        ]);

        $this->assertInstanceOf(Straight::class, $hand->getHandRanking());
    }

    public function testStraightFlushWithoutAce() : void {
        $hand = new Hand([
            new Card(new Suit(\PokerHandValidator\SuitType::Diamonds), 1),
            new Card(new Suit(\PokerHandValidator\SuitType::Diamonds), 2),
            new Card(new Suit(\PokerHandValidator\SuitType::Diamonds), 3),
            new Card(new Suit(\PokerHandValidator\SuitType::Diamonds), 4),
            new Card(new Suit(\PokerHandValidator\SuitType::Diamonds), 5),
        ]);

        $this->assertInstanceOf(StraightFlush::class, $hand->getHandRanking());
    }

    public function testRoyalFlush() : void {
        $hand = new Hand([
            new Card(new Suit(\PokerHandValidator\SuitType::Diamonds), 0),
            new Card(new Suit(\PokerHandValidator\SuitType::Diamonds), 12),
            new Card(new Suit(\PokerHandValidator\SuitType::Diamonds), 11),
            new Card(new Suit(\PokerHandValidator\SuitType::Diamonds), 10),
            new Card(new Suit(\PokerHandValidator\SuitType::Diamonds), 9),
        ]);

        $this->assertInstanceOf(RoyalFlush::class, $hand->getHandRanking());
    }
}