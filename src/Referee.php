<?php

class Referee
{
    protected $game;
    
    function __construct($game)
    {
        $this->game = $game;
    }

    /**
     * @return the index of the first foundation where $card can go on
     *         and null if no foundation found
     */
    public function canGoOnFoundations($card)
    {
        $foundations = $this->game->getFoundations();
        
        foreach ($foundations as $stack) {
            if ($stack->isEmpty()) {
                // Foundations start always with the same number
                if ($foundations[0]->readLast()->getNumber() == $card->getNumber()) {
                    return $stack;
                }
            } elseif ($this->canGoOnFoundation($stack, $card)) {
                return $stack;
            }
        }
        
        return null;
    }
    
    /**
     * @return the index of the first pile where $card can go on
     *         and null if no pile found
     */
    public function canGoOnPiles($card)
    {
        $piles = $this->game->getPiles();
        
        foreach ($piles as $stack) {
            if ($this->canGoOnPiles($stack, $card)) {
                return $stack;
            }
        }
        
        return null;
    }
    
    public function canGoOnFoundation($stack, $card)
    {
        if ($stack == null || $stack->isEmpty()) {
            throw new Exception("No valid stack given.");
        }

        $parentCard = $stack->readFirst();
        
        if ($parentCard->getColor() != $card->getColor()) {
            return false;
        }
        
        if ($parentCard->getNumber() == 13) {
            return $card->getNumber() == 1;
        } else {
            return $card->getNumber() == $parentCard->getNumber() + 1;
        }
    }
    
    public function canGoOnPile($stack, $card)
    {
        if ($stack == null) {
            throw new Exception("No valid stack given.");
        }
        
        if ($stack->isEmpty()) {
            return true;
        }
        
        $parentCard = $stack->readFirst();
        
        if (($parentCard->isRed() && !$card->isBlack()) || ($parentCard->isBlack() && !$card->isRed())) {
                return false;
        }
        
        if ($parentCard->getNumber() == 1) {
            return $card->getNumber() == 13;
        } else {
            $card->getNumber() == $parentCard->getNumber() - 1;
        }
    }
}
