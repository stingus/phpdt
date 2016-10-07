<?php

namespace PHPdt\UnitTest\DataType;

use PHPdt\DataType\ArrayDataType;

class ArrayTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider validDataProvider
     * @param $data
     */
    public function testValidArray($data)
    {
        $this->assertTrue(ArrayDataType::validateType($data));
    }

    /**
     * @dataProvider invalidDataProvider
     * @param $data
     */
    public function testInvalidArray($data)
    {
        $this->expectException('PHPdt\\DataType\\Exceptions\\InvalidDataTypeException');
        ArrayDataType::validateType($data);
    }

    public function validDataProvider()
    {
        return [
            [
                [1, 2, 3]
            ],
            [
                ['a', 'b', 'c']
            ],
            [
                [true, false]
            ],
            [
                [new \stdClass(), new \stdClass()]
            ],
            [
                [-.1, 0, 1]
            ],
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
            [0],
            [1],
            [new \stdClass()]
        ];
    }
}
