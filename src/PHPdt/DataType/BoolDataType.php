<?php

namespace PHPdt\DataType;

/**
 * Class BoolDataType.
 * Bool data type
 *
 * @package PHPdt\DataType
 */
class BoolDataType extends PrimitiveDataType
{
    /**
     * @inheritdoc
     */
    public static function typeValidator()
    {
        return function ($value) {
            return is_bool($value);
        };
    }
}
