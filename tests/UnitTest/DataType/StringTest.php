<?php

namespace PHPdt\UnitTest\DataType;

use PHPdt\DataType\StringDataType;

class StringTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider validDataProvider
     * @param $data
     */
    public function testValidString($data)
    {
        $this->assertTrue(StringDataType::validateType($data));
    }

    /**
     * @dataProvider invalidDataProvider
     * @param $data
     */
    public function testInvalidString($data)
    {
        $this->expectException('PHPdt\\DataType\\Exceptions\\InvalidDataTypeException');
        StringDataType::validateType($data);
    }

    public function validDataProvider()
    {
        return [
            ['a'],
            ['A'],
            ['abc'],
            ['ABC'],
            ['!@#$%^&*{}:"|<>?/.,~\\\'']
        ];
    }

    public function invalidDataProvider()
    {
        return [
            [true],
            [false],
            [1],
            [0],
            [null],
            [-.1],
            [.1],
            [new \stdClass()],
            [[1, 2, 3]]
        ];
    }
}
