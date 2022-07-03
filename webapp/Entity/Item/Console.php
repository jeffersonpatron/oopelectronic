<?php

namespace WebApp\Entity\Item;

use WebApp\Entity\EntityItem;
use WebApp\Interfaces\ExtrasInterface;

class Console extends EntityItem implements ExtrasInterface
{
    const EXTRAS_QUANTITY = 4;

    private $extras = array();

    public function maxExtras() : bool
    {
        return $this->countExtras() < self::EXTRAS_QUANTITY;
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