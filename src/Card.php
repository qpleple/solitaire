<?php

class Card
{
    protected $color;
    protected $number;

    const HEART   = 4;
    const SPADE   = 3;
    const DIAMOND = 2;
    const CLUB    = 1;
    
    function __construct($color, $number) {
        $this->color = $color;
        $this->number = $number;
    }
    
    public function getColor()
    {
        return $this->color;
    }
    
    public static function getColors()
    {
        return array(self::HEART, self::SPADE, self::DIAMOND, self::CLUB);
    }
    
    public static function isColor($color)
    {
        return in_array($color, array(self::HEART, self::SPADE, self::DIAMOND, self::CLUB));
    }
    
    public function setColor($color)
    {
        if (!self::isColor($color)) {
            throw new SolitaireException(sprintf(NOT_A_COLOR_MSG, $color), NOT_A_COLOR);
        }
        
        $this->color = $color;
    }
    
    public function getNumber()
    {
        return $this->number;
    }
    
    public static function isNumber($number)
    {
        return is_int($number) && ($number >= 1) && ($number <= 13);
    }

    public function setNumber($number)
    {
        if (!self::isNumber($number)) {
            throw new SolitaireException(sprintf(NOT_A_NUMBER_MSG, $number), NOT_A_NUMBER);
        }
        
        $this->number = $number;
    }
    
    public function getNumbers()
    {
        return array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13);
    }
}