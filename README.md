## Schematic Protocol

The purpose of this library is to create a schema transfer protocol with the ability to export and import XML.

### How does it work

The library helps us create new data types with strict validation and a defined structure.


### Data types:

In current version, there are 4 data types: **Field**, **List**, **Operator**, **Schema**.
Every created object is immutable, once created, you cannot change it.

### Data type: Trebel\Schematic\Field

Fields are the smallest points of data types, the value of any "Field" must be primitive or we can see below can be Operator: 

```php
namespace Example\Fields\User;

use Trebel\Schematic\Field;

class ID extends Field {
    function __construct($value) {
        parent::__construct($value);
    }

    public function validate($value): bool {
        return ctype_digit($value) && $value > 0;
    }
}

class Name extends Field {
    function __construct($value) {
        parent::__construct($value);
    }

    public function validate($value): bool {
        return is_string($value) && strlen($value) > 0 && strlen($value) < 255;
    }
}
```


### Data type: Trebel\Schematic\Schema

Schema data type is object-like type, each schema can contain Field, List, or other Schema data types.

```php
namespace Example;

use Trebel\Schematic\Schema;

class Person extends Schema {
    function __construct(...$args){
        parent::__construct(...$args);
    }

    public static $schema = [
        'Example\Fields\User\ID',
        'Example\Fields\User\Name',
    ];
}
```

Then we can create our first Schema object:

```php
$person = new Example\Person([
    new Example\UserId(1234),
    new Example\UserName('Jhone'),
])

echo $person->id . "\n"; // Ourput: "1234"
echo $person->id->innerItem() . "\n"; // Ourput: 1234 // absolute value
```

> `ID` is required field for each Schema data type

### Data type: Trebel\Schematic\Collection (List)

__Collection__ Why not List? beacouse of list is reserved word in PHP

Lists are data types similar to arrays, and the only difference between a Schema and a List is that List can only handle one type, while Schema can handle any.

```php
namespace Example;

use Trebel\Schematic\Collection;

class Persons extends Collection {
    protected static $type = 'Example\Person'; // Required

    function __construct(...$arg) {
        parent::__construct(...$arg);
    }
}

// To use Lists

$persons = new Examples\Persons([
    new Persons( ... ),
    new Persons( ... )
])

```

### Data type: Trebel\Schematic\Operator

Operators are special types, not to define an element, but to modify it.

For example, suppose we have a schema **Car** with fields **ID** and **Price**, and in the case where we want to change the price to add or subtract existing price, 
we can create **Increase** operator inside **Price**

```php
$carTwo = new Schemas\Car([
    new Fields\Car\ID(31),
    new Fields\Car\Price(
        new Operators\Increase(123),
    )
]);
```

In this version, the operators only work on the Field and List data types.
There are defined operators

 **Push** (Trebel\Schematic\Operators\Push),   
 **Pull** (Trebel\Schematic\Operators\Pull)   
 for **List** data type

 **Increase** (Trebel\Schematic\Operators\Increase)   
 for **Field** data type

But you can create your own data types as well.

To support any operator on a Field or List, you need to define all the operators within the types.

```php
class Cars extends Collection {
    public static $type = 'Examples\Schemas\Car';
    public static $operators = [
        'Trebel\Schematic\Operators\Push',
        'Trebel\Schematic\Operators\Pull',
    ];

    function __construct(...$arg) {
        parent::__construct(...$arg);
    }
}
```

```php
// Example
new Lists\Cars([
    new Operators\Push(
        new Schemas\Car([
            new Fields\Car\ID(33),
            new Fields\Car\Name('Ford'),
            new Fields\Car\Price(15000)
        ])
    ),
    // Pay attention that Pull operator can be not completed schema
    new Operators\Pull( new Schemas\Car([
        new Fields\Car\ID(31)]
    )),
])
```

### Export / Import

The main part of the library is the ability to export and import XML schemas using a specific protocol.

#### Export Schema 

```php
$exporter = new Trebel\Schematic\Tools\Exporter($schema);
$exporter->export($pathToExport);
```

You can only import a schema, not a field, list, or operator.

Let's look at a specific example:

```php
$person = new Schemas\Person([
    new Fields\User\ID(15),
    new Lists\Cars([
        new Operators\Push(
            new Schemas\Car([
                new Fields\Car\ID(33),
                new Fields\Car\Name('Ford'),
                new Fields\Car\Price(15000)
            ])
        ),
        new Operators\Pull( new Schemas\Car([
            new Fields\Car\ID(31)]
        )),
    ])
])

$exporter = new Trebel\Schematic\Tools\Exporter($person);
$exporter->export('/tmp/example/index.xml');
```

Outpout xml files could be:

File: /tmp/example/index.xml

```xml
<?xml version="1.0" encoding="UTF-8"?>
<Content>
	<Person>
		<ID>15</ID>
		<Cars>
			<Push>
				<Car src="Car/33.xml"/>
			</Push>
			<Pull>
				<Car src="Car/31.xml"/>
			</Pull>
		</Cars>
	</Person>
</Content>
```

File: /tmp/example/Car/33.xml

```xml
<?xml version="1.0" encoding="UTF-8"?>
<Content>
	<Car>
		<ID>33</ID>
		<Name>Ford</Name>
		<Price>15000</Price>
	</Car>
</Content>
```

and the same for Car/31.xml

Another example:

```php
$car = new Schemas\Car([
    new Fields\Car\ID(31),
    new Fields\Car\Price(
        new Operators\Increase(500),
    )
]);
```

output:

```xml
<?xml version="1.0" encoding="UTF-8"?>
<Content>
	<Car>
		<ID>31</ID>
		<Price>
            <Increase>500</Increase>
        </Price>
	</Car>
</Content>
```

#### Import Schema 

```php
$importer = new Trebel\Schematic\Tools\Importer([ .. list of supported schmeas]);
$schema = $importer->import($pathToSchema);
```

Concrete example:

```php
$importer = new Tools\Importer([
    'Examples\Schemas\Car',
    'Examples\Schemas\Person',
    'Examples\Schemas\Toyota',
]);

$car = $importer->import('/tmp/car/index.xml');
```

#### Conclusion

For more information, check out the tutorials located in the ```examples``` folder