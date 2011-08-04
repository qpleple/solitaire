<?php

class Cli
{
    const BEGIN_COLOR_RED = "\033[;31m";
    const BEGIN_COLOR_BLACK = "\033[;34;1m";
    const END_COLOR = "\033[;m";
    
    public static function red($string)
    {
        return ($string == "") ? "" : BEGIN_COLOR_RED . $string . END_COLOR;
    }
    
    public static function black($string)
    {
        return ($string == "") ? "" : BEGIN_COLOR_BLACK . $string . END_COLOR;
    }
    
    public static function colorize($card)
    {
        if (!($card instanceof Card)) {
            throw new Exception("Should be a card.");
        }
        
        if ($card->isRed()) {
            return Cli::red($card);
        }
        
        return Cli::black($card);
    }
    
    public static function strlen($string) {
        if ($string == "") {
            return 0;
        }
        
        $len = strlen($string);
        
        // Count 1 character for each color symbol
        $colorCounts = array();
        foreach (Card::getColors() as $color) {
            preg_match_all("/" . $color . "/", $string, $matches);
            $colorCounts[$color] = $matches ? count($matches[0]) : 0;
        }
        
        foreach ($colorCounts as $color => $count) {
            $len -= ($count == 0) ? 0 : (strlen($color) - 2) * $value;
        }
        
        // Ignore CLI color tags
        preg_match_all(BEGIN_COLOR_RED, $string, $matches);
        $number = $matches ? count($matches[0]) : 0;
        $len -= (strlen(BEGIN_COLOR_RED) + strlen(END_COLOR)) * $number;
        
        preg_match_all(BEGIN_COLOR_BLACK, $string, $matches);
        $number = $matches ? count($matches[0]) : 0;
        $len -= (strlen(BEGIN_COLOR_BLACK) + strlen(END_COLOR)) * $number;
        
        if ($len <= 0) {
            throw new Exception("Length should not be null: not an empty string");
        }
        
        return  $len;
    }
    
    public static function concat($blocks, $spacing = "")
    {
        $lines = array();
        
        // computes height of final block = max of all blocks height
        $height = 0;
        foreach ($blocks as $i => $block) {
            $lines[$i] = explode("\n", $block);
            $height = max($height, count($lines[$i]));
        }
        
        foreach ($blocks as $i => $block) {
            // computes width of the block = max of all lines width
            $width = 0;
            foreach ($lines[$i] as $line) {
                $width = max($width, Cli::strlen($line));
            }

            // fills lines with blank (until width) and ends lines with spacing pattern
            for ($j = 0; $j < $height; $j++) {
                $line = $j < count($lines[$i]) ? $lines[$i][$j] : "";
                
                
                $toAdd = $width - Cli::strlen($line);
                for ($k = 0; $k < $toAdd; $k++) { 
                    $line .= " ";
                }
                
                // add spacing if not last block
                $line .= ($i == count($blocks) - 1) ? "" : $spacing;
                $lines[$i][$j] = $line;
            }   
        }
        
        $finalLines = array();
        // concats blocks
        for ($i = 0; $i < $height; $i++) {
            $finalLine = "";
            foreach ($lines as $blockLines) {
                $finalLine .= $blockLines[$i];
            }
            $finalLines[] = $finalLine;
        }
        
        return implode("\n", $finalLines) . "\n";
    }
}