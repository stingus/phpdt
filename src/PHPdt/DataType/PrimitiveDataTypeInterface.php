<?php

namespace PHPdt\DataType;

/**
 * Interface PrivitiveDataTypeInterface.
 * Interface for implementing primitive data types
 *
 * @package PHPdt\DataType
 */
interface PrimitiveDataTypeInterface
{
    /**
     * Type validator method to be implemented by each primitive data type
     *
     * @return \Closure
     */
    public static function typeValidator();
}
