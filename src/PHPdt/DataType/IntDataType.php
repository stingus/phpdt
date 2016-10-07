<?php

namespace PHPdt\DataType;

/**
 * Class IntDataType.
 * Integer data type
 *
 * @package PHPdt\DataType
 */
class IntDataType extends PrimitiveDataType
{
    /**
     * @inheritdoc
     */
    public static function typeValidator()
    {
        return function ($value) {
            return is_int($value);
        };
    }
}
