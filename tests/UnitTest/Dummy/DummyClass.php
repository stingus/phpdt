<?php

namespace PHPdt\UnitTest\Dummy;

use PHPdt\DataType\DataTypeInterface;
use PHPdt\DataType\ObjectValidationTrait;

abstract class DummyClass implements DataTypeInterface
{
    use ObjectValidationTrait;
}
