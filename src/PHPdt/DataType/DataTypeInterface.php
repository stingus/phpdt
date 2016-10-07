<?php

namespace PHPdt\DataType;

use PHPdt\DataType\Exceptions\InvalidDataTypeException;

/**
 * Interface DataTypeInterface
 * @package PHPdt\DataType
 */
interface DataTypeInterface
{
    /**
     * Check if a value is type-valid
     *
     * @param mixed $value
     * @return true
     * @throws InvalidDataTypeException
     */
    public static function validateType($value);
}
