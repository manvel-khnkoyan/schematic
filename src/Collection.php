<?php

namespace Peeghe\Schematic;

use Peeghe\Schematic\Interfaces\Property;
use Peeghe\Schematic\Operator;

abstract class Collection implements Property, \Iterator {
    protected $type = null;
    protected $list = [];
    protected $position = 0;

    public function validateReference($type): bool {
        return is_a($this, $type);
    }

    public function __construct($list) {
        $this->position = 0;
        if (!is_array($list)) {
            throw new \Exception("Lists should receive only array");
        }

        $itemType = null;
        foreach ($list as $key => $item) {

            /*
             * Check if all the items has the same type */
            $type = get_parent_class($item) ?? get_class($item);
            if (!$itemType) $itemType = $type;
            if ($itemType !== $type) {
                throw new \Exception(
                    "Lists ". get_class($item) ." should have same type of items"
                );
            }

             /*
             * Check if all the items are implementation of Property */
             if (!($item instanceof Property)) {
                throw new \Exception(
                    "Lists ". get_class($item) ." index [$key] is invalid. " . 
                    "Each list element must be instance of [Property]"
                );  
            }

            /*
             * When items are operators */
            if ($item instanceof Operator) {
                $item->validateReference(get_class($item));
            }

            if ($this->type !== get_class($item)) {
                throw new \Exception(
                    get_class($this)." has invalid type at index: $key"
                );
            }
            $this->list[] = $item;
        }
    }

    public function rewind(): void {
        $this->position = 0;
    }

    public function current() : mixed {
        return $this->list[$this->position];
    }

    public function key() : mixed {
        return $this->position;
    }

    public function next(): void {
        ++$this->position;
    }

    public function valid(): bool {
        return isset($this->list[$this->position]);
    }
}