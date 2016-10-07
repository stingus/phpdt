<?php

namespace PHPdt\DataType;

/**
 * Class DoubleDataType.
 * Double data type
 *
 * @package PHPdt\DataType
 */
class DoubleDataType extends PrimitiveDataType
{
    /**
     * @inheritdoc
     */
    public static function typeValidator()
    {
        return function ($value) {
            return is_float($value);
        };
    }
}
