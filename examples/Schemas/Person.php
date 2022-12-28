<?php

namespace Examples\Schemas;

use Trebel\Schematic\Schema;

/**
 * [Description Person]
 */
class Person extends Schema {
    /**
     * @param mixed ...$args
     */
    function __construct(...$args) {
        parent::__construct(...$args);
    }

    public static $schema = [
        'Examples\Fields\User\ID',
        'Examples\Fields\User\Name',
        'Examples\Lists\Cars',
    ];
}
