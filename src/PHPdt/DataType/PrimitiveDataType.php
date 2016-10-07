<?php

namespace PHPdt\DataType;

use PHPdt\DataType\Exceptions\InvalidDataTypeException;

/**
 * Class DataType
 * @package PHPdt\DataType
 */
abstract class PrimitiveDataType implements DataTypeInterface, PrimitiveDataTypeInterface
{
    /**
     * @inheritDoc
     */
    public static function validateType($value)
    {
        $validator = static::typeValidator();
        if (!$validator($value)) {
            throw new InvalidDataTypeException(static::class, $value);
        }
        return true;
    }
}
