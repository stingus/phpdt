<?php

namespace PHPdt\DataType;

/**
 * Class StringDataType.
 * String data type
 *
 * @package PHPdt\DataType
 */
class StringDataType extends PrimitiveDataType
{
    /**
     * @inheritdoc
     */
    public static function typeValidator()
    {
        return function ($value) {
            return is_string($value);
        };
    }
}
