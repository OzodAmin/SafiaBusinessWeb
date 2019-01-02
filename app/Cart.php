<?php

namespace App;

class Cart
{
    public $items = null;
    public $totalQty = 0;
    public $totalPrice = 0;

    public function __construct($oldCart)
    {
        if ($oldCart) {
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
        }
    }

    public function add($item, $id)
    {
        if ($this->items) {
            if (array_key_exists($id, $this->items)) {
                return;
            }
        }
        $this->items[$id] = $item;
        $this->totalQty += 1;
        $this->totalPrice += $item->price;
    }

    public function removeItem($id)
    {
        $this->totalQty -= 1;
        $this->totalPrice -= $this->items[$id]['price'];
        unset($this->items[$id]);
    }
}
