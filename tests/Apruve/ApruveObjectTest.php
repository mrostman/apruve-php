<?php

require_once dirname(__FILE__) . '/../../src/Apruve/ApruveObject.php';

class TestClass extends ApruveObject
{
  var $first;
  var $third;
  var $second;

  protected static $hash_order = [
    'first',
    'second',
    'third',
  ];

  protected static $json_fields = [
    'second',
    'first'
  ];
}

class ApruveObjectTest extends PHPUnit_Framework_TestCase
{

  protected function setUp() {
    $this->object = new TestClass([
      'third' => 3,
      'first' => 1,
      'second' => 'second',
    ]);
  }

  public function testPropertiesAreDefined()
  {
    $vars = get_class_vars(get_class($this->object));

    $this->assertEquals(array_keys($vars),array(
      'first',
      'third',
      'second',
    ));
    $this->assertEquals(3, count($vars));
  }

  public function testToHashString()
  {
    $this->assertEquals(
      '1second3', $this->object->toHashString());
  }

  public function testToJsonString()
  {
    $this->assertJsonStringEqualsJsonString(
      '{"first": 1, "second": "second" }',
      $this->object->toJsonString()
    );
  }
}
