<?php

namespace Trebel\Schematic;

use Trebel\Schematic\Property;
use Trebel\Schematic\Field;
use Trebel\Schematic\Collection;

/**
 * Schema
 */
abstract class Schema extends Property implements \Iterator {

    public static $schema = [];
    protected $__properties = [];

    /**
     * @return [type]
     */
    public function isCompleted() {
        return count($this::$schema) === count($this->__properties);
    }

    /**
     * @param mixed $properites
     */
    function __construct($properites) {
        foreach ($properites as $item) {
            // Get Type of Item
            $type = get_class($item);

            // Get Key
            $namespaces = explode('\\', get_class($item));
            $key = end($namespaces);

            // check if property was defined
            if (!in_array($type, $this::$schema)) {
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

    /**
     * @param mixed $key
     * 
     * @return [type]
     */
    public function __get($key) {
        if (isset($this->__properties[$key])) {
            return $this->__properties[$key];
        }
        return null;
    }

    /**
     * @param mixed $key
     * @param mixed $value
     * 
     * @return [type]
     */
    public function __set($key, $value) {
        if (isset($this->__properties[$key])) {
            $this->__properties[$key] = $value;
        }
    }

    /**
     * @param mixed $key
     * 
     * @return [type]
     */
    public function __isset($key) {
        return isset($this->__properties[$key]);
    }

    /**
     * @return void
     */
    function rewind(): void {
        reset($this->__properties);
    }

    /**
     * @return mixed
     */
    function current(): mixed {
        return current($this->__properties);
    }

    /**
     * @return mixed
     */
    function key(): mixed {
        return key($this->__properties);
    }

    /**
     * @return void
     */
    function next(): void {
        next($this->__properties);
    }

    /**
     * @return bool
     */
    function valid(): bool {
        return key($this->__properties) !== null;
    }
}
