<?php

namespace Omnipay\PayKasa;

use Omnipay\Tests\GatewayTestCase;

class GatewayTest extends GatewayTestCase
{
    /**
     * @var Gateway
     */
    public $gateway;

    public function setUp()
    {
        parent::setUp();
        $this->gateway = new Gateway($this->getHttpClient(), $this->getHttpRequest());
        $this->gateway->setToken('merchant_token');
    }

    public function testPurchase()
    {
        $request = $this->gateway->purchase(array(
            'amount'        => 12.43,
            'currency'      => 'EUR',
            'transactionId' => 'TX2229777',
            'customerId'    => 'qbc10002',
            'voucherCode'   => 1388185689033560
        ));

        $this->assertInstanceOf('\Omnipay\PayKasa\Message\PurchaseRequest', $request);
        $this->assertSame('qbc10002', $request->getCustomerId());
        $this->assertSame(1388185689033560, $request->getVoucherCode());
    }

    public function testPayout()
    {
        $request = $this->gateway->payout(array(
            'amount'        => 12.43,
            'currency'      => 'EUR',
            'transactionId' => 'TX2229777',
            'voucherType'   => 'Cash'
        ));

        $this->assertInstanceOf('\Omnipay\PayKasa\Message\PayoutRequest', $request);
        $this->assertSame('Cash', $request->getVoucherType());
    }

    public function testFetchTransaction()
    {
        $request = $this->gateway->fetchTransaction(array(
            'transactionId'        => 'TX5557666',
            'transactionReference' => 'XXAACCD3231232'
        ));

        $this->assertInstanceOf('\Omnipay\PayKasa\Message\FetchTransactionRequest', $request);
        $this->assertSame('TX5557666', $request->getTransactionId());
        $this->assertSame('XXAACCD3231232', $request->getTransactionReference());
    }

    public function testFetchVoucherProducts()
    {
        $request = $this->gateway->fetchVoucherProducts();
        $this->assertInstanceOf('\Omnipay\PayKasa\Message\FetchVoucherProductsRequest', $request);
    }
}
