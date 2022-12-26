<?php

namespace Trebel\Schematic;

use Trebel\Schematic\Property;
use Trebel\Schematic\Field;
use Trebel\Schematic\Collection;

abstract class Schema extends Property implements \Iterator {

    protected $__properties = [];

    public function isCompleted() {
        return count($this->__schema) === count($this->__properties);
    }

    function __construct($properites) {

        foreach ($properites as $item) {
            // Get Type of Item
            $type = get_class($item);

            // Get Key
            $namespaces = explode('\\', get_class($item));
            $key = end($namespaces);

            // check if property was defined
            if (!in_array($type, $this->__schema)) {
                throw new \Exception(
                    "Schema " . get_class($this) . " [$type] is not defined"
                );
            }

            // Check if insteance of Property
            if (
                !($item instanceof Field) &&
                !($item instanceof Collection)
            ) {
                throw new \Exception(
                    "Schema " .
                        get_class($this) .
                        " [$type] must be Field or Collection"
                );
            }

            // Set Property
            $this->__properties[$key] = $item;
        }

        if (!$this->ID) {
            throw new \Exception(
                get_class($this) . " must have [ID] property"
            );
        }
    }

    public function __get($key) {
        if (isset($this->__properties[$key])) {
            return $this->__properties[$key];
        }
        return null;
    }

    public function __set($key, $value) {
        if (isset($this->__properties[$key])) {
            $this->__properties[$key] = $value;
        }
    }

    public function __isset($key) {
        return isset($this->__properties[$key]);
    }

    function rewind(): void {
        reset($this->__properties);
    }

    function current(): mixed {
        return current($this->__properties);
    }

    function key(): mixed {
        return key($this->__properties);
    }

    function next(): void {
        next($this->__properties);
    }

    function valid(): bool {
        return key($this->__properties) !== null;
    }
}
