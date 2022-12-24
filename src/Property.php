<?php

namespace Xnko\Schematic;

class Property
{

    /*
     * This function created special for validating
     * parent reference: Each schema property must have
     * validateType function to validate dependenciess */
    public function validateType($type): bool
    {
        /* 
         * Otherwise check exact type */
        return is_a($this, $type);
    }
}
