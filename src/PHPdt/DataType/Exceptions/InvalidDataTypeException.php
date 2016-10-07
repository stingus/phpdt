<?php

namespace PHPdt\DataType\Exceptions;

/**
 * Class InvalidDataTypeException
 * @package PHPdt\DataType
 */
class InvalidDataTypeException extends \Exception
{
    /**
     * InvalidDataTypeException constructor.
     * @param string $type Expected data type
     * @param mixed  $data Offending data
     */
    public function __construct($type, $data)
    {
        $dataType = gettype($data);
        if (is_object($data)) {
            $dataType = get_class($data);
        }
        parent::__construct(sprintf('Invalid data type <%s>, expecting <%s>', $dataType, $type));
    }
}
