<?php

namespace Trebel\Schematic;

/**
 * [Description Property]
 */
class Property {

    /*
     * This function created special for validating
     * parent reference: Each schema property must have
     * validateType function to validate dependenciess 
     *
     * @param mixed $type
     * @return void
     */
    public function validateType($type): void {
        /* 
         * Otherwise check exact type */
        if (!is_a($this, $type)) {
            throw new \Exception(
                "Schema type [" . get_class($this) . "] is inappropriate for [$type]"
            );
        }
    }
}
