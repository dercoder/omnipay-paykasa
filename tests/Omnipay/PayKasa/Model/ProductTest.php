<?php

namespace Omnipay\PayKasa\Message;

use Omnipay\PayKasa\Model\Product;
use Omnipay\Tests\TestCase;

class ProductTest extends TestCase
{
    public function testValid()
    {
        $data = array(
            'name'         => '10.01EUR',
            'currency'     => 'EUR',
            'amount'       => '10.01',
            'voucher_type' => 'Cash'
        );

        $product = new Product($data);
        $this->assertSame($data, $product->getData());
        $this->assertSame('10.01EUR', $product->getName());
        $this->assertSame('EUR', $product->getCurrency());
        $this->assertSame(10.01, $product->getAmount());
        $this->assertSame(1001, $product->getAmountInteger());
        $this->assertSame('Cash', $product->getVoucherType());
    }

    public function testInvalid()
    {
        $data = array();

        $product = new Product($data);
        $this->assertSame($data, $product->getData());
        $this->assertNull($product->getName());
        $this->assertNull($product->getCurrency());
        $this->assertNull($product->getAmount());
        $this->assertNull($product->getAmountInteger());
        $this->assertNull($product->getVoucherType());
    }
}