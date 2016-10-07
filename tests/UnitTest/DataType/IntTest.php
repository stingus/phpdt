<?php

namespace PHPdt\UnitTest\DataType;

use PHPdt\DataType\IntDataType;

class IntTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider validDataProvider
     * @param $data
     */
    public function testValidInt($data)
    {
        $this->assertTrue(IntDataType::validateType($data));
    }

    /**
     * @dataProvider invalidDataProvider
     * @param $data
     */
    public function testInvalidInt($data)
    {
        $this->expectException('PHPdt\\DataType\\Exceptions\\InvalidDataTypeException');
        IntDataType::validateType($data);
    }

    public function validDataProvider()
    {
        return [
            [~PHP_INT_MAX],[0], [PHP_INT_MAX]
        ];
    }

    public function invalidDataProvider()
    {
        return [
            [true],
            [false],
            ['1'],
            ["1"],
            ['0'],
            [null],
            [-.1],
            [.1],
            [new \stdClass()],
            [[1, 2, 3]]
        ];
    }
}
