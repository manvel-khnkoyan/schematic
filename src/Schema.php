<?php

namespace Peegh\Schematic;

use Peegh\Schematic\Interfaces\Property;

abstract class Schema implements Property{

    private $__properties = [];
    protected $__completed = null;
    
    public function completed() {
        return $this->__completed;
    }

    public function validateType($originType) : bool {
        return is_a($this, $originType);
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

    function __construct($properites) {
        // Check ID
        if (!isset($properites['id'])) {
            throw new \Exception(
                "Internal ".get_class($this)." scheme should have [id] key"
            );
        }

        // Loop through input input
        foreach ($properites as $key => $item) {
            if (!isset($this->__schema[$key])) {
                throw new \Exception(
                    "Internal ".get_class($this)." scheme $key not found"
                );
            }

            // Get Schem
            $schema = $this->__schema[$key];
            if (!(is_a($item, $schema))) {
                throw new \Exception(
                    "Schema ".get_class($item)." should be $schema"
                );
            }

            // check if implemntees Property
            if (!($item instanceof Property)) {
                throw new \Exception(
                    "Schema ".get_class($this)." property [$key] is invalid" . 
                    "Schema property must be List, Field, Schema, Resource or Operator"
                );  
            }

            // Validate Type
            if (!$item->validateType($schema)) {
                throw new \Exception(
                    "Schema ".get_class($this)." $key should be $schema"
                ); 
            }
        }

        /*
         * See if schema has all the fields */
        $this->__completed = true;
        foreach ($this->__schema as $key => $schema) {
            if (!isset($properites[$key])) {
                $this->__completed = false;
            }
        }

        echo $properites['id']." : [" . $this->__completed . "]\n";

        // If everithing is ok then own Properities
        $this->__properties = $properites;
    }
}
