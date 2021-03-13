<?php

namespace App\Models;

class Cart
{
    public $items;
    public $totalQty = 0;
    public $priceWithoutDiscount = 0;
    public $discount = 0;
    public $totalPrice = 0;
    public $size = 0;

    public function __construct($oldCart)
    {
        if ($oldCart) {
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
            $this->discount = $oldCart->discount;
            $this->priceWithoutDiscount = $oldCart->priceWithoutDiscount;
            $this->size = $oldCart->size;
        }
    }

    public function add($item, $id)
    {
        $storedItem = ['qty' => 0,'priceWithoutDiscount' => $item->price_without_discount, 'price' => $item->price, 'item' => $item, 'size' => 0];
        if ($this->items) {
            if (array_key_exists($id, $this->items)) {
                $storedItem = $this->items[$id];
            }
        }
        $storedItem['qty']++;
        $storedItem['price'] = $item->price * $storedItem['qty'];
        $storedItem['priceWithoutDiscount'] = $item->price_without_discount * $storedItem['qty'];
        $this->items[$id] = $storedItem;
        $this->totalQty++;
        $this->totalPrice += $item->price;
        $this->priceWithoutDiscount  +=  $item->price_without_discount;
        $this->discount =  $this->priceWithoutDiscount - $this->totalPrice;
    }

    public function add_with_count($item, $id, $count, $size)
    {
        $storedItem = ['qty' => 0, 'priceWithoutDiscount' => $item->price_without_discount , 'price' => $item->price, 'item' => $item, 'size' => 0];

        if ($this->items) {
            if (array_key_exists($id, $this->items)) {
               $storedItem = $this->items[$id];
            }
        }
            $storedItem['size'] =  $size;
            $storedItem['qty'] += $count;
            $storedItem['price'] = $item->price * $storedItem['qty'];
            $storedItem['priceWithoutDiscount'] = $item->price_without_discount * $storedItem['qty'];
            $this->items[$id] = $storedItem;
            $this->totalQty += $count;
            $this->totalPrice += $item->price * $count;
            $this->priceWithoutDiscount  +=  $item->price_without_discount * $count;
            $this->size = $size;
            $this->discount =  $this->priceWithoutDiscount - $this->totalPrice;
    }

    public function reduceByOne($id)
    {
        $this->items[$id]['qty']--;
        $this->items[$id]['price'] -= $this->items[$id]['item']['price'];
        $this->items[$id]['priceWithoutDiscount'] -= $this->items[$id]['item']['price_without_discount'];
        $this->totalQty--;
        $this->totalPrice -= $this->items[$id]['item']['price'];
        $this->priceWithoutDiscount -= $this->items[$id]['item']['price_without_discount'];
        $this->discount =  $this->priceWithoutDiscount - $this->totalPrice;
        if ($this->items[$id]['qty'] <= 0) {
            unset($this->items[$id]);
        }
    }

    public function removeItem($id)
    {
        $this->totalQty -= $this->items[$id]['qty'];
        $this->totalPrice -= $this->items[$id]['price'];
        $this->priceWithoutDiscount -= $this->items[$id]['priceWithoutDiscount'];
        $this->discount =  $this->priceWithoutDiscount - $this->totalPrice;
        unset($this->items[$id]);
    }

}


