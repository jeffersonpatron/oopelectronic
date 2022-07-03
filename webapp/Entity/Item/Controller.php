<?php

namespace WebApp\Entity\Item;

use WebApp\Entity\EntityItem;
use WebApp\Interfaces\ExtrasInterface;


class Controller extends EntityItem implements ExtrasInterface
{
    const EXTRAS_QUANTITY = 0;

    public function maxExtras(): bool
    {
        if (self::EXTRAS_QUANTITY == 0) {
            return false;
        }

        return true;
    }
}