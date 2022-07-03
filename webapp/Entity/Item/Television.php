<?php

namespace WebApp\Entity\Item;

use WebApp\Entity\EntityItem;
use WebApp\Interfaces\ExtrasInterface;

class Television extends EntityItem implements ExtrasInterface
{
    
    const EXTRAS_QUANTITY = "unlimited";

    private $extras = array();

    public function maxExtras() : bool
    {
        return true;
    }

    public function setExtras(EntityItem $item) : void
    {
        $this->extras[] = $item;
    }

    public function getExtras() : array
    {
        return $this->extras;
    }

    public function countExtras() : int
    {
        return count($this->extras);
    }

}