## Schematic Protocol

Purpose of this library is to create schema transfer protocol with XML export and import abilities.

### Schema

Trebel\Schematic\Schema

A schema is a dictionary-like object that has properties, each property can currently be of the following 4 types:

**Field**,
**List**,
**Operator**,
**Schema**,

`And each objects are immutable`

### Field

Trebel\Schematic\Field

Fields are the smallest point of the Schemes. Lets degine UserId and UserName fields:


```php
namespace Example;

use Trebel\Schematic\Field;

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

After we have created two types of fields, we can define the first schema with thses two fields:


```php
namespace Example;

use Trebel\Schematic\Schema;

class Person extends Schema {
    function __construct(...$args){
        parent::__construct(...$args);
    }

    public static $schema = [
        'Example\UserId',
        'Example\UserName',
    ];
}
```

Then we can create our first Schema object:

```php

$personOne = new Example\Person([
    new Example\UserId(1234),
    new Example\UserName('Jhone'),
])


echo $personOne->id . "\n"; // Ourput: "1234"
// Or to get absoulte value
echo $personOne->id->innerItem() . "\n"; // Ourput: 1234
```

### List

Trebel\Schematic\Collection

__Collection__ Why not List? beacouse of list is reserved word in PHP

Lists are schema lists like schema, but only difference is Schema can handle diffenerent types, but Lists can handle only one type:

```php
namespace Example;

use Trebel\Schematic\Collection;

class Persons extends Collection {
    // Discribing Lists item type
    protected $type = 'Example\Person';

    function __construct(...$arg) {
        parent::__construct(...$arg);
    }
}

// To use Lists

$persons = new Examples\Persons([
    $personOne,
    $personTwo,
])

```

### Operators

Operators are special for mutation of any field

## XML Serializer


```xml
<xml>
    <package action="create">
        <person>
            <id>20927</id>
            <name>Jhone</name>
            <cars>
                <car>
                    <id>24</id>
                    <name>Toyota</name>
                </car>
            </cars>
        </person>
    </package>
</xml>
```



```xml
<xml>
    <package action="update">
        <person>
            <id>20927</id>
            <cars>
                <push type="operator">
                    <car>
                        <id>25</id>
                        <name>BMW</name>
                    </car>
                </push>
            </cars>
        </person>
    </package>
</xml>
```



```xml
<xml>
    <package action="update">
        <person>
            <id>20927</id>
            <carNames>
                <CarName />
                <CarName />
                <CarName />
            </cars>
        </person>
    </package>
</xml>
```


```xml
<xml>
    <Content version="1.0" action="Update">
        <Release>
            <ID key="id">12301928</ID>
            <Price key="">
                <Increase type="operator">1</Increase>
            </Price>
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
    </Content>
</xml>
```

```xml
<xml>
    <Entity action="Update">
        <ReleaseSetting>
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
    </Entity>
</xml>
```

```xml
<xml>
    <Entity version="1.0">
        <Track action="Delete">
            <ID>12301928</ID>
        <Track>
    </Entity>
</xml>
```

