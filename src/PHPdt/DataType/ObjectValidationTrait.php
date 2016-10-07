<?php

namespace PHPdt\DataType;

use PHPdt\DataType\Exceptions\InvalidDataTypeException;

/**
 * Trait ObjectValidationTrait.
 * This trait can be used in classes implementing DataTypeInterface for covering the validation contract.
 * It validates if the instance is the same as the class / interface implementing DataTypeInterface
 *
 * @package PHPdt\DataType
 */
trait ObjectValidationTrait
{
    /**
     * Validate object type
     *
     * @param $value
     * @return bool
     * @throws InvalidDataTypeException
     */
    public static function validateType($value)
    {
        if (get_called_class() === $value) {
            return true;
        }
        if (array_key_exists($value, class_implements(get_called_class()))) {
            return true;
        }
        if (array_key_exists($value, class_parents(get_called_class()))) {
            return true;
        }
        throw new InvalidDataTypeException($value, new static);
    }
}
