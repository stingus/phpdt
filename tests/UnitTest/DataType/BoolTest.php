<?php

namespace PHPdt\UnitTest\DataType;

use PHPdt\DataType\BoolDataType;

class BoolTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider validDataProvider
     * @param $data
     */
    public function testValidBool($data)
    {
        $this->assertTrue(BoolDataType::validateType($data));
    }

    /**
     * @dataProvider invalidDataProvider
     * @param $data
     */
    public function testInvalidBool($data)
    {
        $this->expectException('PHPdt\\DataType\\Exceptions\\InvalidDataTypeException');
        BoolDataType::validateType($data);
    }

    public function validDataProvider()
    {
        return [
            [true], [false]
        ];
    }

    public function invalidDataProvider()
    {
        return [
            [-1],
            [0],
            [1],
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
