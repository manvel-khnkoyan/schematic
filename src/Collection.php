<?php

namespace Peeghe\Schematic;

use Peeghe\Schematic\Interfaces\Property;
use Peeghe\Schematic\Operator;

abstract class Collection implements Property, \Iterator {
    protected $type = null;
    protected $list = [];
    protected $position = 0;

    public function __construct($list) {
        $this->position = 0;
        if (!is_array($list)) {
            throw new \Exception("Lists should receive only array");
        }

        $itemType = null;
        foreach ($list as $key => $item) {

             /*
             * Check if all the items are implementation of Property */
             if (!($item instanceof Property)) {
                throw new \Exception(
                    "Lists [N:$key] item has invalid type: " . gettype($item) . ". " .
                    "Each list element must be instance of [Property]"
                );  
            }

            /*
             * Validate Reference: */
            if (!$item->validateReference($this->type)) {
                throw new \Exception(
                    "List " . get_class($this) . " index [$key] must be type of " .
                    $this->type .". " . get_class($item) . " given"
                ); 
            }

            /*
             * */
            $this->list[] = $item;
        }
    }

    public function validateReference($type): bool {
        return is_a($this, $type);
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