<?php

namespace Trebel\Schematic\Operators;

use Trebel\Schematic\Operator;
use Trebel\Schematic\Collection;

/**
 * List pull operator
 * Special to add items to list
 */
class Push extends Operator {
    /**
     * @param mixed ...$arg
     */
    function __construct(...$arg) {
        parent::__construct(...$arg);
    }

    /**
     * @param mixed $list
     * 
     * @return void
     */
    public function validateType($list): void {
        // Call parent function
        parent::validateType($list);

        // Check if $list actually is list
        if (!($list instanceof Collection)) {
            throw new \Exception(
                "Pull should be only inside List, but its under: " . get_class($list)
            );
        }

        // Check if List Type is the same as Operator item
        if ($list::$type !== get_class($this->value)) {
            throw new \Exception(
                "Push operator value should be the same type as [" . $list::$type . "]"
            );
        }

        // Pull operator must be completed object
        if (!$this->value->isCompleted()) {
            throw new \Exception("Push operator should be completed item, for [" . $list::$type . "]");
        }
    }
}
