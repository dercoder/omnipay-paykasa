<?php

namespace Omnipay\PayKasa\Message;

use Omnipay\Tests\TestCase;

class PurchaseRequestTest extends TestCase
{
    /**
     * @var PurchaseRequest
     */
    private $request;

    public function setUp()
    {
        parent::setUp();
        $this->request = new PurchaseRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->initialize(array(
            'token'             => 'merchant_token',
            'amount'            => 12.43,
            'currency'          => 'EUR',
            'transactionId'     => 'TX2229777',
            'customerId'        => 'qbc10002',
            'voucherCode'       => 1388185689033560,
            'customerIpAddress' => '127.0.0.1',
            'customerCountry'   => 'GB',
            'customerEmail'     => 'customer@example.com'
        ));
    }

    public function testGetData()
    {
        $data = $this->request->getData();
        $this->assertSame(1388185689033560, $data['voucher_code']);
        $this->assertSame('TX2229777', $data['customer_order_id']);
        $this->assertSame('qbc10002', $data['customer_id']);
        $this->assertSame('12.43', $data['amount']);
        $this->assertSame('127.0.0.1', $data['customer_ip_addr']);
        $this->assertSame('GB', $data['customer_country']);
        $this->assertSame('customer@example.com', $data['customer_email']);
    }

    public function testSendDataSuccess()
    {
        $this->setMockHttpResponse('PurchaseSuccess.txt');
        $data = $this->request->getData();
        $response = $this->request->sendData($data);
        $this->assertInstanceOf('Omnipay\PayKasa\Message\PurchaseResponse', $response);
    }

    public function testSendDataFailure()
    {
        $this->setMockHttpResponse('PurchaseFailure.txt');
        $data = $this->request->getData();
        $response = $this->request->sendData($data);
        $this->assertInstanceOf('Omnipay\PayKasa\Message\PurchaseResponse', $response);
    }
}
