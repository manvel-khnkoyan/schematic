<?php

namespace Trebel\Schematic;

use Trebel\Schematic\Property;
use Trebel\Schematic\Operator;

/**
 * [Description Collection]
 */
abstract class Collection extends Property implements \Iterator {
    public $type = null;
    static public $operators = [];

    protected $list = [];
    protected $position = 0;

    /**
     * @param mixed $list
     */
    public function __construct($list) {
        $this->position = 0;
        if (!is_array($list)) {
            throw new \Exception("Lists should only receive an array");
        }

        foreach ($list as $key => $item) {
            // validate item
            if (!($item instanceof Property)) {
                $itype = gettype($item);
                throw new \Exception(
                    "Lists [$key] item has invalid item: [$itype]"
                );
            }

            // Validate type
            $item->validateType(
                $item instanceof Operator ? $this : $this->type
            );

            $this->list[] = $item;
        }
    }

    public function rewind(): void {
        $this->position = 0;
    }

    public function current(): mixed {
        return $this->list[$this->position];
    }

    public function key(): mixed {
        return $this->position;
    }

    public function next(): void {
        ++$this->position;
    }

    public function valid(): bool {
        return isset($this->list[$this->position]);
    }
}
