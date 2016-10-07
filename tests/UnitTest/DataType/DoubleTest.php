<?php

namespace PHPdt\UnitTest\DataType;

use PHPdt\DataType\DoubleDataType;

class DoubleTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider validDataProvider
     * @param $data
     */
    public function testValidDouble($data)
    {
        $this->assertTrue(DoubleDataType::validateType($data));
    }

    /**
     * @dataProvider invalidDataProvider
     * @param $data
     */
    public function testInvalidDouble($data)
    {
        $this->expectException('PHPdt\\DataType\\Exceptions\\InvalidDataTypeException');
        DoubleDataType::validateType($data);
    }

    public function validDataProvider()
    {
        return [
            [-(PHP_INT_MAX - .000000000000001), -1, -.1, 0, .1, 1, (PHP_INT_MAX - 1 + .999999999999999)]
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
            [-1],
            [1],
            [new \stdClass()],
            [[1, 2, 3]]
        ];
    }
}
