
# PHPdt
This library implements strict data type validation for PHP.

[![Build Status](https://travis-ci.org/stingus/phpdt.svg?branch=master)](https://travis-ci.org/stingus/phpdt)
[![Code Climate](https://codeclimate.com/github/stingus/phpdt/badges/gpa.svg)](https://codeclimate.com/github/stingus/phpdt)
[![Test Coverage](https://codeclimate.com/github/stingus/phpdt/badges/coverage.svg)](https://codeclimate.com/github/stingus/phpdt/coverage)

## Supported data types

- Primitives: integer, double, boolean, string, array
- User-defined classes and interfaces

## Installation

Install via composer:

```sh
php composer.phar require stingus/phpdt
```
## Tests

You can run the test suite using:

```sh
vendor/bin/phpunit
```

## Documentation

You can generate [PHPDoc](https://www.phpdoc.org/), which will create a `phpdoc` directory containing HTML API documentation.

```sh
php phpDocumentor.phar
```

## Usage

### Primitives

```php
use PHPdt\DataType\Exceptions\InvalidDataTypeException;
use PHPdt\DataType\IntDataType;

class Foo
{
    private $dataType;

    private $data;

    public function __construct($dataType)
    {
        $this->dataType = $dataType;
    }

    // Set data after validating it has the strict type $this->dataType;
    public function setData($data)
    {
        try {
            $dataType = $this->dataType;
            $dataType::validateType($data);
            $this->data = $data;
            return true;
        } catch (InvalidDataTypeException $e) {
            return false;
        }
    }
}

// Build Foo with Integer data validation
// You can choose from 5 predefined primitives: integer, double, string, bool, array
$foo = new Foo(IntDataType::class);
$foo->setData(1); // True
$foo->setData('1'); // False
```
### User-defined objects
```php

use PHPdt\DataType\DataTypeInterface;
use PHPdt\DataType\Exceptions\InvalidDataTypeException;

// User-defined class must implement DataTypeInterface
class Bar implements DataTypeInterface
{
    public static function validateType($value)
    {
        if ($value instanceof Bar) {
            return true;
        }
        return false;
    }
}

class Foo
{
    private $dataType;

    private $data;

    public function __construct($dataType)
    {
        $this->dataType = $dataType;
    }

    public function setData($data)
    {
        // $data is the validator
        if ($data instanceof DataTypeInterface) {
            try {
                $data::validateType($this->dataType);
                $this->data = $data;
                return true;
            } catch (InvalidDataTypeException $e) {
                return false;
            }
        }
        return false;
    }
}

// Build Foo with Bar data validation
$foo = new Foo(Bar::class);
$foo->setData(new Bar()); // True
$foo->setData(new stdClass()); // False

```
### Traits usage
There are two traits that can be used as helpers in user-defined classes:

#### ObjectValidationTrait
This trait implements the validateType() method from DataTypeInterface.
It helps building a validation model based on parent classes and interfaces.
Suppose you want to validate that an object is implementing a certain interface
or is a child of a concrete or abstract class. Using this trait makes validation
a breeze:

```php

use PHPdt\DataType\DataTypeInterface;
use PHPdt\DataType\Exceptions\InvalidDataTypeException;
use PHPdt\DataType\ObjectValidationTrait;

interface Qux
{
}

abstract class Baz implements Qux, DataTypeInterface
{
    use ObjectValidationTrait;
}

class Bar extends Baz
{
}

class Foo
{
    private $dataType;

    private $data;

    public function __construct($dataType)
    {
        $this->dataType = $dataType;
    }

    public function setData($data)
    {
        // Now $data is the validator
        if ($data instanceof DataTypeInterface) {
            try {
                $data::validateType($this->dataType);
                $this->data = $data;
                return true;
            } catch (InvalidDataTypeException $e) {
                return false;
            }
        }
        return false;
    }
}

// Validation on interface
$foo = new Foo(Qux::class);
$foo->setData(new Bar()); // True, Bar implements Qux

// Validation on abstract
$foo = new Foo(Baz::class);
$foo->setData(new Bar()); // True, Bar extends Baz
```

#### ValidationTypeTrait
This trait helps implementing the validation method in the client objects.
You don't have to worry about implementing the correct validation for
primitives or used-defined classes, just use the validateType() method from
this trait:

```php
use PHPdt\DataType\DataTypeInterface;
use PHPdt\DataType\Exceptions\DataTypeImplementationException;
use PHPdt\DataType\Exceptions\InvalidDataTypeException;
use PHPdt\DataType\ObjectValidationTrait;
use PHPdt\DataType\ValidationTypeTrait;

class Baz
{
}

class Bar implements DataTypeInterface
{
    use ObjectValidationTrait;
}

class Foo
{
    use ValidationTypeTrait;

    private $dataType;

    private $data;

    public function __construct($dataType)
    {
        $this->dataType = $dataType;
    }

    public function setData($data)
    {
        try {
            self::validateType($data, $this->dataType);
            $this->data = $data;
            return true;
        } catch (InvalidDataTypeException $e) {
            // Data type mismatch
            return false;
        } catch (DataTypeImplementationException $e) {
            // $dataType (for primitives) or $data (for user-defined classes) is not implementing DataTypeInterface
            return false;
        }
    }
}

$foo = new Foo(Bar::class);
$foo->setData(new Bar()); // True

$foo = new Foo(Baz::class);
$foo->setData(new Baz()); // False, Baz is not implementing DataTypeInterface

```
