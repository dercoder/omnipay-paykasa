<?php

namespace Omnipay\PayKasa\Message;

use Omnipay\Tests\TestCase;

class PayoutRequestTest extends TestCase
{
    /**
     * @var PayoutRequest
     */
    private $request;

    public function setUp()
    {
        parent::setUp();
        $this->request = new PayoutRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->initialize(array(
            'token'         => 'issuer_token',
            'amount'        => 12.43,
            'currency'      => 'EUR',
            'transactionId' => 'TX2229888',
            'voucherType'   => 'Cash',
        ));
    }

    public function testGetData()
    {
        $data = $this->request->getData();
        $this->assertSame('Cash', $data['voucher_type']);
        $this->assertSame('TX2229888', $data['customer_order_id']);
        $this->assertSame('EUR', $data['currency']);
        $this->assertSame('12.43', $data['amount']);
    }

    public function testSendDataSuccess()
    {
        $this->setMockHttpResponse('PayoutSuccess.txt');
        $data = $this->request->getData();
        $response = $this->request->sendData($data);
        $this->assertInstanceOf('Omnipay\PayKasa\Message\PayoutResponse', $response);
    }

    public function testSendDataFailure()
    {
        $this->setMockHttpResponse('PayoutFailure.txt');
        $data = $this->request->getData();
        $response = $this->request->sendData($data);
        $this->assertInstanceOf('Omnipay\PayKasa\Message\PayoutResponse', $response);
    }
}
