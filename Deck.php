<?php

class Deck
{
    private $cards
    
    function __construct($cards)
    {
        $this->cards = $cards;
    }
    
    public function getCards()
    {
        return $this->$cards;
    }
    
    public function setCards($cards)
    {
        $this->cards = $cards;
    }
}
