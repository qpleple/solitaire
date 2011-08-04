<?php

class CliRendering
{
    protected $lib;
    
    function __construct($lib = null) {
        $this->lib = $lib;
    }
    
    public function renderStack($stack, $firstOnly = false)
    {
        if ($stack == null or !($stack instanceof Stack)) {
            throw new Exception("No stack provided.");
        }
        
        if ($stack->isEmpty()) {
            return $this->lib->render("empty_slot.twig");
        }
        
        if (!(is_bool($firstOnly))) {
            throw new Exception("No boolean provided.");
        }
        
        if ($firstOnly || $stack->size() == 1) {
            return $this->lib->render("card.twig", array(
                "label" => Cli::colorize($stack->readFirst()),
                "sideUp" => $stack->isSideUp(),
            ));
        }

        $cards = $stack->getCards();
        
        $labels = array();
        foreach ($cards as $card) {
            $labels[] = self::colorize($card);
        }
        
        return $this->lib->render("stack.twig", array(
            "labels" => $labels,
            "sideUp" => $stack->isSideUp(),
        ));
    }
    
    public function renderGame($game)
    {
        // Foundations
        $foundations = array();
        foreach ($game->getFoundations() as $foundation) {
            $foundations[] = $this->renderStack($foundation);
        }
        $strFoundations = "         foundations\n" . Cli::concat($foundations, "   ");
        
        // Piles
        $piles = array();
        foreach ($game->getPiles() as $pile) {
            $piles[] = $this->renderStack($pile);
        }
        $strPiles = "            piles\n" . Cli::concat($piles, "   ");
    
        // Reserve
        $reserve = $game->getReserve();
        $strReserve = "reserve(". $reserve->size() . ")\n" . $this->renderStack($reserve);
        
        // Deck
        $deck = $game->getDeck();
        $strDeck = "deck(" . $deck->size() . ")\n" . $this->renderStack($deck);
        
        // Waste
        $waste = $game->getWaste();
        $strWaste = "waste(" . $waste->size() . ")\n" . $this->renderStack($waste);
    
        return Cli::concat(array($strFoundations . "\n" . $strPiles, $strReserve, $strDeck, $strWaste), "        ");
    }
}