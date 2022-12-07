<?php

namespace Peegh\Schematic\Interfaces;

interface Property {
    public function validateType($originType) : bool;
}