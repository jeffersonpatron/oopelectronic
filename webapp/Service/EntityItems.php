<?php

namespace WebApp\Service;

use WebApp\Entity\EntityItem;

class EntityItems
{

    private $items = array();

    public function __construct(array $items)
    {
        $this->items = $items;
    }


    public function getSortedItems()
    {
        $sorted = array();

        foreach ($this->items as $item) {
            $sorted[$item->getPrice()] = $item;
        }

        ksort($sorted, SORT_NUMERIC);

        return $sorted;
    }

    public function getItemsByType($type)
    {

        if (in_array($type, EntityItem::$types)) {
            
            $callback = function($item) use ($type) {
                return $item->getType() == $type;
            };

            return array_filter($this->items, $callback);
        }

        return false;
    }

    public function getTotalPrice() : float
    {
        $total = 0.00;

        foreach ($this->items as $item) {
            $total += $item->getPrice();

            if ($item::EXTRAS_QUANTITY != 0 && !empty($item->getExtras())) {
                $total += $this->getTotalPriceOfExtras($item->getExtras());
            }
        }

        return number_format($total, 2, '.', '');
    }

    public function getTotalPriceByType(string $type) : float
    {
        $total = 0.00;

        $items = $this->getItemsByType($type);

        if (!$items) {
            return $total;
        }

        foreach ($items as $item) {
            $total += $item->getPrice();

            if ($item::EXTRAS_QUANTITY != 0 && !empty($item->getExtras())) {
                $total += $this->getTotalPriceOfExtras($item->getExtras());
            }
        }

        return number_format($total, 2, '.', '');
    }

    private function getTotalPriceOfExtras(array $extras) : float
    {
        $total = 0.00;

        foreach ($extras as $item) {
            $total += $item->getPrice();
        }

        return number_format($total, 2, '.', '');
    }
}