<?php

namespace PHPdt\UnitTest\DataType;

use PHPdt\DataType\IntDataType;
use PHPdt\UnitTest\Dummy\Client;
use PHPdt\UnitTest\Dummy\DummyClassOneOne;
use PHPdt\UnitTest\Dummy\DummyClassOneOneChild;
use PHPdt\UnitTest\Dummy\DummyClassOneTwo;
use PHPdt\UnitTest\Dummy\DummyClassThreeOne;
use PHPdt\UnitTest\Dummy\DummyClassTwoOne;
use PHPdt\UnitTest\Dummy\DummyInterfaceOne;
use PHPdt\UnitTest\Dummy\DummyInterfaceThree;

class UserDefinedTest extends \PHPUnit_Framework_TestCase
{
    public function testClientDifferentTypes()
    {
        $this->expectException('PHPdt\\DataType\\Exceptions\\InvalidDataTypeException');
        $client = new Client(IntDataType::class);
        $client->set('1');
    }

    public function testClientSameInterface()
    {
        $client = new Client(DummyInterfaceOne::class);
        $data = new DummyClassOneOne();
        $client->set($data);
        $this->assertSame($data, $client->get());
    }

    public function testClientDifferentInterface()
    {
        $this->expectException('PHPdt\\DataType\\Exceptions\\InvalidDataTypeException');
        $client = new Client(DummyInterfaceOne::class);
        $client->set(new DummyClassTwoOne());
    }

    public function testClientSameClass()
    {
        $client = new Client(DummyClassOneOne::class);
        $data = new DummyClassOneOne();
        $client->set($data);
        $this->assertSame($data, $client->get());
    }

    public function testClientDifferentClasses()
    {
        $this->expectException('PHPdt\\DataType\\Exceptions\\InvalidDataTypeException');
        $client = new Client(DummyClassOneOne::class);
        $client->set(new DummyClassTwoOne());
    }

    public function testClientDifferentClassesSameInterface()
    {
        $this->expectException('PHPdt\\DataType\\Exceptions\\InvalidDataTypeException');
        $client = new Client(DummyClassOneOne::class);
        $client->set(new DummyClassOneTwo());
    }

    public function testClientClassInheritance()
    {
        $client = new Client(DummyClassOneOne::class);
        $data = new DummyClassOneOneChild();
        $client->set($data);
        $this->assertSame($data, $client->get());
    }

    public function testClientInvalidDataTypeClass()
    {
        $this->expectException('PHPdt\\DataType\\Exceptions\\DataTypeImplementationException');
        $client = new Client(\stdClass::class);
        $client->set(new \stdClass());
    }

    public function testClientInvalidDataTypeInterface()
    {
        $this->expectException('PHPdt\\DataType\\Exceptions\\DataTypeImplementationException');
        $client = new Client(DummyInterfaceThree::class);
        $client->set(new DummyClassThreeOne());
    }

    public function testClientObjectDataTypeWithoutInterfacePrimitiveInput()
    {
        $this->expectException('PHPdt\\DataType\\Exceptions\\DataTypeImplementationException');
        $client = new Client(\stdClass::class);
        $client->set(1);
    }

    public function testClientObjectDataTypeWithWrongInterfacePrimitiveInput()
    {
        $this->expectException('PHPdt\\DataType\\Exceptions\\DataTypeImplementationException');
        $client = new Client(DummyClassThreeOne::class);
        $client->set(1);
    }
}
