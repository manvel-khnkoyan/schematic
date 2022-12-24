<?php

namespace Xnko\Schematic;

use Xnko\Schematic\Property;

abstract class Collection extends Property implements \Iterator
{
    protected $type = null;
    protected $list = [];
    protected $position = 0;

    public function __construct($list)
    {
        
        $this->position = 0;
        if (!is_array($list)) {
            throw new \Exception("Lists should receive only array");
        }

        foreach ($list as $key => $item) {
            /*
             * Check if all the items are implementation of Property */
            if (!($item instanceof Property)) {
                throw new \Exception(
                    "Lists [N:$key] item has invalid type: " .
                        gettype($item) .
                        ". " .
                        "Each list element must be instance of [Property]"
                );
            }

            /*
             * Validate Reference: */
            if (!$item->validateType($this->type)) {
                throw new \Exception(
                    "List [" . get_class($this) . "] has invalid [" . get_class($item) . "] item"
                );
            }

            /*
             * */
            $this->list[] = $item;
        }
    }

    public function rewind(): void
    {
        $this->position = 0;
    }

    public function current(): mixed
    {
        return $this->list[$this->position];
    }

    public function key(): mixed
    {
        return $this->position;
    }

    public function next(): void
    {
        ++$this->position;
    }

    public function valid(): bool
    {
        return isset($this->list[$this->position]);
    }
}
