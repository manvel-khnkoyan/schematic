# Catalog Feed Protocol

Schematic data types data exchange and command protocol

### Schema

Peegh\Schematic\Schema

A schema is a dictionary-like object that has properties, each property can currently be of the following 5 types:

**Filed**,
**List**,
**Resource**,
**Operator**,
**Schema**,
**Filed**


### Field

Peegh\Schematic\Field

Fields are the smallest point of the Schemes:



```php
namespace MyExample;

use Peegh\Schematic\Field;

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
```


After we have created two types of fields, we can easily create the first schema.


```php
namespace MyExample;

use Peegh\Schematic\Schema;

class Person extends Schema {
    function __construct(...$args){
        parent::__construct(...$args);
    }

    protected $__schema = [
        'id' => 'MyExample\UserId',
        'name' => 'MyExample\UserName',
    ];
}
```


Then we can create our first Schema object:

```php

$userOne = new MyExample\Person([
    'id' => new MyExample\UserId(1234),
    'name' => new MyExample\UserName('Jhone'),
])

// Then You cane get 

echo $userOne->id . "\n";

// Or To get absolute value 

```

### List

Peegh\Schematic\Collection

__Collection__ Why not List? beacouse of list is reserved word in PHP



```php
namespace MyExample;

use Peegh\Schematic\Collection;

class Persons extends Collection {
    protected $type = 'MyExample\Person';

    function __construct(...$arg) {
        parent::__construct(...$arg);
    }
}

schema

```


```xml
<xml>
    <Schema version="1.0" action="Update">
        <Release>
            <ID>12301928</ID>
            <UpdateCount type="Operator">
                <Increase>1</Increase>
            </UpdateCount>
            <Resources type="Operator">
                <Pull>
                    <Resource />
                </Pull>
                <Push>
                    <Resource />
                </Push>
            </Resources>
            <Images>
                <Resource type="Resource">
                    <FilePath mimetType="image/jpeg">/tmp/example.jpg</FilePath>
                </Resource>
            </Images>
        </Release>
    </Schema>
</xml>
```

```xml
<xml>
    <Schema version="1.0">
        <ReleaseSetting action="Update">
            <ID>12301928</ID>
            <Territories type="operator">
                <Pull>
                    <Country>US</Country>
                    <Country>MX</Country>
                </Pull>
                <Push>
                    <Country>US</Country>
                    <Country>MX</Country>
                </Push>
            </Territories>
        </ReleaseSetting>
    </Schema>
</xml>
```

```xml
<xml>
    <Schema version="1.0">
        <Track action="Delete">
            <ID>12301928</ID>
        <Track>
    </Schema>
</xml>
```

