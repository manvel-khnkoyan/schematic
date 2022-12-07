<?php

namespace MyExample;

require __DIR__ . '/../vendor/autoload.php';

use Peegh\Schematic\Field;
use Peegh\Schematic\Lists\Operators;
use Peegh\Schematic\Schema;

class UserId extends Field {
    function __construct($value) {
        parent::__construct($value);
    }

    public function validate($value): bool {
        return (is_int($value) || ctype_digit($value)) && $value > 0;
    }
}

class UserName extends Field {
    function __construct($value) {
        parent::__construct($value);
    }

    public function validate($value): bool {
        return is_string($value) && strlen($value) > 0 && strlen($value) < 255;
    }
}

class Person extends Schema {
    function __construct(...$args){
        parent::__construct(...$args);
    }

    protected $__schema = [
        'id' => 'MyExample\UserId',
        'name' => 'MyExample\UserName',
    ];
}

$userOne = new Person([
    'id' => new UserId(1234),
    'name' => new UserName('Jhone'),
]);


$userOne = new Person([
    'id' => new UserId(1234),
    'name' => new UserName('Jhone'),
    'type' => new Lists\Operators([
        new Operators\Push(),
        new Operators\Pull(),
    ]),
]);


echo $userOne->id->value();

