<?php

// The first card of the stack is the last of the array $cards

class Stack
{
    protected $cards;
    protected $sideUp = true;
    
    function __construct($cards = array())
    {
        $this->setCards($cards);
    }
    
    public function getCards()
    {
        return $this->cards;
    }
    
    public function setCards($cards)
    {
        if (!is_array($cards)) {
            throw new Exception("Not an array given");
        }
        
        if (!empty($cards) && !($cards[0] instanceof Card)) {
            throw new Exception("Not an array of cards");
        }
        
        $this->cards = $cards;
    }

    public function isSideUp()
    {
        return $this->sideUp;
    }

    public function setSideUp($sideUp)
    {
        if (!is_bool($sideUp)) {
            throw Exception("Not a boolean");
        }
        
        $this->sideUp = $sideUp;
    }
        
    public function shuffle()
    {
        shuffle($this->cards);
    } 
    
    public function size()
    {
        return count($this->cards);
    }
    
    public function pop($number = 1)
    {
        if ($number == 1) {
            return array_pop($this->cards);
        } else {
            $cards = array();
            for ($i = 0; $i < $number; $i++) { 
                $card = array_pop($this->cards);
                if ($card == null) {
                    break;
                }
                $cards[] = $card; 
            }
            return $cards;
        }
    }
    
    // Reverse order
    public function push($cards)
    {
        foreach ($cards as $card) {
            $this->cards[] = $card;
        }
    }
    
    public static function generateDeck()
    {
        $cards = array();
        
        foreach (Card::getColors() as $color) {
            foreach (Card::getNumbers() as $number) {
                $cards[] = new Card($number, $color);
            }
        }

        $stack = new Stack($cards);
        $stack->shuffle();
        return $stack;
    }
    
    public function flip()
    {
        $this->cards = array_reverse($this->cards);
    }
    
    public function readFirst()
    {
        if ($this->isEmpty()) {
            return null;
        } else {
            return $this->cards[$this->size() - 1];
        }
    }
    
    public function readLast()
    {
        if ($this->isEmpty()) {
            return null;
        } else {
            return $this->cards[0];
        }
    }
    
    public function isEmpty()
    {
        return $this->size() == 0;
    }
    
    public function moveCardsTo($stack, $numberCards, $keepOrder = false)
    {
        $cards = $this->pop($numberCards);
        if ($keepOrder) {
            array_reverse($cards);
        }
        $stack->push($cards);
    }
    
}
