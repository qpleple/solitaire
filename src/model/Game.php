<?php

class Game
{
    protected $deck;
    protected $waste;
    protected $foundations;
    protected $piles;
    protected $reserve;
    
    function __construct($stack)
    {
        if ($stack->size() != 52) {
            throw new Exception(sprintf("52 cards needed to start a game: %s given.", $stack->size()));
        }
        
        $this->deck = $stack;
        $this->deck->setSideUp(false);
        $this->waste = new Stack();
        $this->foundations = array(
            new Stack(array($stack->pop())),
            new Stack(),
            new Stack(),
            new Stack(),
        );
        $this->piles = array(
            new Stack(array($stack->pop())),
            new Stack(array($stack->pop())),
            new Stack(array($stack->pop())),
            new Stack(array($stack->pop())),
        );
        $this->reserve = new Stack($stack->pop(13));
    }
    
    
    public function getDeck()
    {
        return $this->deck;
    }

    public function getWaste()
    {
        return $this->waste;
    }
    
    public function getFoundations()
    {
        return $this->foundations;
    }
    
    public function getPiles()
    {
        return $this->piles;
    }
    
    public function getReserve()
    {
        return $this->reserve;
    }

    public function pop3next()
    {
        if ($this->deck->size() == 0) {
            $this->deck = $this->waste;
            $this->deck->flip();
            $this->waste = new Stack();
        }
        $this->deck->moveCardsTo($this->waste, 3);
    }
}