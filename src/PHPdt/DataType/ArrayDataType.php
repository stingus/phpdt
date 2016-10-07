<?php

namespace PHPdt\DataType;

/**
 * Class ArrayDataType.
 * Array data type
 *
 * @package PHPdt\DataType
 */
class ArrayDataType extends PrimitiveDataType
{
    /**
     * @inheritdoc
     */
    public static function typeValidator()
    {
        return function ($value) {
            return is_array($value);
        };
    }
}
