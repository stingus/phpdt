<?php

namespace PHPdt\DataType;

use PHPdt\DataType\Exceptions\DataTypeImplementationException;

/**
 * Trait ValidationTypeTrait.
 * This trait is used to validate if a particular value matches the data type with which the data structure was
 * constructed
 *
 * @package PHPdt\DataType
 */
trait ValidationTypeTrait
{
    /**
     * Validate if data type checks against data structure type.
     * If data is an object than data itself is the validator, since it needs to implement DataTypeInterface.
     * If data is a primitive, use the $dataType as validator, after validating that $dataType implements
     * DataTypeInterface
     *
     * @param mixed  $data     Data to be validated
     * @param string $dataType Expected type (class, interface)
     * @return true
     * @throws DataTypeImplementationException
     */
    protected function validateType($data, $dataType)
    {
        if (is_object($data)) {
            if (!$data instanceof DataTypeInterface) {
                throw new DataTypeImplementationException(
                    sprintf('The object <%s> must implement <DataTypeInterface>', get_class($data))
                );
            }
            return $data->validateType($dataType);
        }
        $interfaces = class_implements($dataType);
        if (false === $interfaces || !array_key_exists('PHPdt\\DataType\\DataTypeInterface', $interfaces)) {
            throw new DataTypeImplementationException(
                sprintf('Data type <%s> must implement <DataTypeInterface>', $dataType)
            );
        }
        /** @var DataTypeInterface $dataType */
        return $dataType::validateType($data);
    }
}
