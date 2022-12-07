<?php

namespace Peeghe\Schematic\Interfaces;

interface Property {
    /*
     * This function created special for validating
     * parent reference: Each schema property must have 
     * validateReference function to validate dependenciess */
    public function validateReference($type) : bool;
}