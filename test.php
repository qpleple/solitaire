<?php

require_once dirname(__FILE__) . "/src/model/Stack.php";
require_once dirname(__FILE__) . "/src/model/Card.php";
require_once dirname(__FILE__) . "/src/model/Game.php";
require_once dirname(__FILE__) . "/src/utils/Cli.php";
require_once dirname(__FILE__) . "/lib/loader.php";

$cli = new Cli(new Lib());

//$game = new Game(Stack::generateDeck());
//
//$game->pop3next();
//echo $cli->renderGame($game);
//
//$card = $game->getWaste()->readFirst();
//echo $game->canGoOnPiles($card) ?: "null";

try {
    $red = new Card(13, Card::HEART);
    $black = new Card(1, Card::CLUB);
    echo Cli::colorize($red) . " on " . Cli::colorize($black);
    echo $red->canGoOnInPiles($black) ? "y" : "n";
    
} catch (Exception $e) {
    echo $e->getMessage();
}