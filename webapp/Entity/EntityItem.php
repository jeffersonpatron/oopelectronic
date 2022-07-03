<?php

namespace WebApp\Entity;

use WebApp\Interfaces\ExtraInterface;

class EntityItem
{

    private $price;
    private $type;
    private $wired;
    
    const ELECTRONIC_ITEM_CONSOLE = 'Console';
    const ELECTRONIC_ITEM_MICROWAVE = 'Microwave';
    const ELECTRONIC_ITEM_TELEVISION = 'TV';
    
    public static $types = array(
        self::ELECTRONIC_ITEM_CONSOLE,
        self::ELECTRONIC_ITEM_MICROWAVE, 
        self::ELECTRONIC_ITEM_TELEVISION
    );
    
    function getPrice()
    {
        return $this->price;
    }
    
    function getType()
    {
        return $this->type;
    }
    
    function getWired()
    {
        return $this->wired;
    }
    
    function setPrice($price)
    {
        $this->price = $price;
    }
    
    function setType($type)
    {
        $this->type = $type;
    }
    
    function setWired($wired)
    {
        $this->wired = $wired;
    }
}