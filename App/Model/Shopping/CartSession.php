<?php

namespace App\Model\Shopping;

class CartSession implements Cart
{
    private $items = [];

    public function __construct()
    {
        $this->items = $this->restore();
    }

    public function restore()
    {
        return isset($_SESSION['cart']) ? unserialize($_SESSION['cart']) : array();
    }

    public function has($id)
    {
        return isset($this->items[$id]);
    }
    public function add(CartItem $item)
    {
        $id = $item->getProduct()->getId();
        if (!$this->has($id)) {
            $this->items[$id] = $item;
        }
    }

    public function update(CartItem $item)
    {
        $id = $item->getProduct()->getId();
        if ($this->has($id)) {
            if (!$item->getQuantity()) {
                $this->delete($id);
                return;
            }
            $this->items[$id] = $item;
        }
    }
    public function delete($id)
    {
        if ($this->has($id)) {
            unset($this->items[$id]);
        }
    }

    public function getTotal()
    {
        $total = 0;
        foreach ($this->items as $item) {
            $total += $item->getSubTotal();
        }
        return $total;
    }

    public function getCartItems()
    {
        return $this->items;
    }

    public function __destruct()
    {
        $_SESSION['cart'] = serialize($this->items);
    }
}
