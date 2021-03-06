<?php

require_once dirname(__FILE__) . '/../../src/Apruve/LineItem.php';

use Apruve\LineItem;

class LineItemTest extends PHPUnit_Framework_TestCase {

  protected function setUp() {
    $this->item = new LineItem([
      'title' => 'A title',
      'sku' => 'sku',
      'plan_code' => 'plan',
      'amount_cents' => 3400,
      'price_ea_cents' => 3400,
      'quantity' => 1,
      'merchant_notes' => 'some notes.',
      'description' => 'a description.',
      'variant_info' => 'some variation.',
      'vendor' => 'ACME',
      'view_product_url' => 'A Url.',
      'payment_request_id' => '1234',
    ], $this->getMockBuilder('Apruve\Client')
          ->setConstructorArgs(['a key', Apruve\Environment::DEV()])
          ->getMock()
  );
  }

  protected function tearDown() {
    
  }

  public function testPropertiesAreDefined()
  {
    $item_vars = get_class_vars(get_class($this->item));

    $this->assertEquals(array_keys($item_vars),array(
      'id',
      'payment_request_id',
      'title',
      'plan_code',
      'amount_cents',
      'quantity',
      'price_ea_cents',
      'merchant_notes',
      'description',
      'variant_info',
      'sku',
      'vendor',
      'view_product_url',
    ));
    $this->assertEquals(13, count($item_vars));
  }

  public function testToHashString() 
  {
    $this->assertEquals(
      'A titleplan340034001some notes.a description.some variation.skuACMEA Url.',
      $this->item->toHashString()
    );
  }

  public function testToJsonString()
  {
    $this->assertJsonStringEqualsJsonString(
      '{
          "payment_request_id":"1234",
          "title": "A title",
          "plan_code": "plan",
          "amount_cents": 3400,
          "price_ea_cents": 3400,
          "quantity": 1,
          "merchant_notes": "some notes.",
          "description": "a description.",
          "variant_info": "some variation.",
          "sku": "sku",
          "vendor": "ACME",
          "view_product_url": "A Url."
       }', $this->item->toJson()
    );
  }


}

