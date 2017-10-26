<?php

namespace Omnipay\PayKasa\Message;

use Omnipay\PayKasa\Model\Voucher;
use Omnipay\Tests\TestCase;

class VoucherTest extends TestCase
{
    public function testValid()
    {
        $data = array(
            'code'         => '1388184730567973',
            'serial'       => '9474707443953820',
            'currency'     => 'EUR',
            'amount'       => '12.43',
            'expiry_date'  => '2018-10-25T00:00:00.0000000',
            'created_date' => '2017-10-25T15:21:25.4104537Z'
        );

        $voucher = new Voucher($data);
        $this->assertSame($data, $voucher->getData());
        $this->assertSame('1388184730567973', $voucher->getCode());
        $this->assertSame('9474707443953820', $voucher->getSerial());
        $this->assertSame('EUR', $voucher->getCurrency());
        $this->assertSame(12.43, $voucher->getAmount());
        $this->assertSame(1243, $voucher->getAmountInteger());
        $this->assertInstanceOf('DateTime', $voucher->getExpiryDate());
        $this->assertSame('2018-10-25T00:00:00+00:00', $voucher->getExpiryDate()->format('c'));
        $this->assertInstanceOf('DateTime', $voucher->getCreationDate());
        $this->assertSame('2017-10-25T15:21:25+00:00', $voucher->getCreationDate()->format('c'));
    }

    public function testInvalid()
    {
        $data = array();

        $voucher = new Voucher($data);
        $this->assertSame($data, $voucher->getData());
        $this->assertNull($voucher->getCode());
        $this->assertNull($voucher->getSerial());
        $this->assertNull($voucher->getCurrency());
        $this->assertNull($voucher->getAmount());
        $this->assertNull($voucher->getAmountInteger());
        $this->assertNull($voucher->getExpiryDate());
        $this->assertNull($voucher->getCreationDate());
    }
}