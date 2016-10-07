<?php

namespace PHPdt\UnitTest\Dummy;

use PHPdt\DataType\ValidationTypeTrait;

class Client
{
    use ValidationTypeTrait;

    private $dataType;

    private $data;

    public function __construct($dataType)
    {
        $this->dataType = $dataType;
    }

    public function set($data)
    {
        self::validateType($data, $this->dataType);
        $this->data = $data;
    }

    public function get()
    {
        return $this->data;
    }
}
