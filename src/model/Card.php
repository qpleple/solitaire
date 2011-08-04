<?php

class Card
{
    protected $color;
    protected $number;

    const HEART   = "♥";
    const SPADE   = "♠";
    const DIAMOND = "♦ ";
    const CLUB    = "♣";
    
    function __construct($number, $color) {
        $this->setColor($color);
        $this->setNumber($number);
    }
    
    public function __toString()
    {
        $strValue = $this->number;
        
        if ($strValue == 11) {
            $strValue = "J";
        } elseif ($strValue == 12) {
            $strValue = "Q";
        } elseif ($strValue == 13) {
            $strValue = "K";
        } elseif ($strValue == 1) {
            $strValue = "A";
        } elseif ($strValue == 10) {
            $strValue = "0";
        }
        
        return $strValue . $this->color;
    }
    
    public function getColor()
    {
        return $this->color;
    }
    
    public function setColor($color)
    {
        if (!self::isColor($color)) {
            throw new Exception(sprintf("Not a color. Given: %s", $color));
        }
        
        $this->color = $color;
    }

    public static function getColors()
    {
        return array(self::HEART, self::SPADE, self::DIAMOND, self::CLUB);
    }
    
    public static function isColor($color)
    {
        return in_array($color, $this->getColors());
    }
    
    public function isRed()
    {
        return in_array($this->getColor(), array(Card::HEART, Card::DIAMOND));
    }
    
    public function isBlack()
    {
        return in_array($this->getColor(), array(Card::CLUB, Card::SPADE));
    }
    
    public function getNumber()
    {
        return $this->number;
    }
    
    public function setNumber($number)
    {
        if (!self::isNumber($number)) {
            throw new Exception(sprintf("Not a number. Given: %s", $number));
        }
        
        $this->number = $number;
    }

    public static function isNumber($number)
    {
        return is_int($number) && ($number >= 1) && ($number <= 13);
    }
    
    public function getNumbers()
    {
        return array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13);
    }
}