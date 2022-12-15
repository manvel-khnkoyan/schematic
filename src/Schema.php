<?php

namespace Peeghe\Schematic;

use Peeghe\Schematic\Property;

abstract class Schema extends Property
{
    protected $__properties = [];
    protected $__full = null;

    public function isFull()
    {
        return $this->__full;
    }

    function __construct($properites)
    {
        // Check ID
        if (!isset($properites['id'])) {
            throw new \Exception(
                "Internal " . get_class($this) . " scheme should have [id] key"
            );
        }

        // Loop through input input
        foreach ($properites as $key => $item) {
            // check if property was defined
            if (!isset($this->__schema[$key])) {
                throw new \Exception(
                    "Schema " . get_class($this) . " key [$key] are not defined"
                );
            }

            // check if insteance of Property
            if (!($item instanceof Property)) {
                throw new \Exception(
                    "Schema " .
                        get_class($this) .
                        " [$key] must be insteance of Property"
                );
            }

            // Validate Reffernece
            $schema = $this->__schema[$key];
            if (!$item->validateReference($schema)) {
                throw new \Exception(
                    "Schema " .
                        get_class($this) .
                        " has given invalid type: " .
                        get_class($item)
                );
            }
        }

        /*
         * See if schema has all the fields */
        $this->__full = true;
        foreach ($this->__schema as $key => $schema) {
            if (!isset($properites[$key])) {
                $this->__full = false;
            }
        }

        // If everithing is ok then own Properities
        $this->__properties = $properites;
    }

    public function __get($key)
    {
        if (isset($this->__properties[$key])) {
            return $this->__properties[$key];
        }
        return null;
    }

    public function __set($key, $value)
    {
        if (isset($this->__properties[$key])) {
            $this->__properties[$key] = $value;
        }
    }

    public function __isset($key)
    {
        return isset($this->__properties[$key]);
    }
}
