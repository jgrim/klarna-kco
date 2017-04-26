<?php namespace KlarnaKco;

use Countable;
use ArrayAccess;
use IteratorAggregate;
use KlarnaKco\Traits\Arrayable;
use KlarnaKco\Traits\Collection;

abstract class CollectionAbstract implements ArrayAccess, Countable, IteratorAggregate
{
    use Collection;
    use Arrayable;

    public function toArray()
    {
        $items = [];
        foreach ($this as $item) {
            $items[] = $item->toArray();
        }

        return $items;
    }
}
