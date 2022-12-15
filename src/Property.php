<?php

namespace Peeghe\Schematic;

class Property
{

    /*
     * This function created special for validating
     * parent reference: Each schema property must have
     * validateReference function to validate dependenciess */
    public function validateReference($type): bool
    {
        /* 
         * Otherwise check exact type */
        return is_a($this, $type);
    }
}
