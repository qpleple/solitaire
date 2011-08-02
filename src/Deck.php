<?php

class Deck
{
    protected $cards;
    
    function __construct()
    {
        $this->cards = array();
        
        foreach (Card::getColors() as $color) {
            foreach (Card::getNumbers() as $number) {
                $this->cards[] = new Card($color, $number);
            }
        }

        $this->shuffle();
    }
    
    public function getCards()
    {
        return $this->$cards;
    }
    
    public function setCards($cards)
    {
        $this->cards = $cards;
    }
        
    public function shuffle()
    {
        shuffle($this->cards);
    }
}
