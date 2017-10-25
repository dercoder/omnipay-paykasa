<?php

namespace Omnipay\PayKasa\Message;

use Omnipay\Tests\TestCase;

class PayoutResponseTest extends TestCase
{
    /**
     * @var PayoutRequest
     */
    protected $request;

    public function setUp()
    {
        parent::setUp();
        $this->request = new PayoutRequest($this->getHttpClient(), $this->getHttpRequest());
    }

    public function testSuccess()
    {
        $httpResponse = $this->getMockHttpResponse('PayoutSuccess.txt');
        $response = new PayoutResponse($this->request, $httpResponse->json());

        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isCancelled());
        $this->assertFalse($response->isPending());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('00', $response->getCode());
        $this->assertSame('Great success', $response->getMessage());
        $this->assertSame('TX2229777', $response->getTransactionId());
        $this->assertSame('VI-26347', $response->getTransactionReference());
        $this->assertSame('1388184730567973', $response->getVoucherCode());
        $this->assertSame('9474707443953820', $response->getVoucherSerial());
        $this->assertSame('EUR', $response->getVoucherCurrency());
        $this->assertSame(12.43, $response->getVoucherAmount());
        $this->assertInstanceOf('DateTime', $response->getVoucherExpiryDate());
        $this->assertSame('2018-10-25T00:00:00+00:00', $response->getVoucherExpiryDate()->format('c'));
        $this->assertInstanceOf('DateTime', $response->getVoucherCreationDate());
        $this->assertSame('2017-10-25T15:21:25+00:00', $response->getVoucherCreationDate()->format('c'));
    }

    public function testFailure()
    {
        $httpResponse = $this->getMockHttpResponse('PayoutFailure.txt');
        $response = new PayoutResponse($this->request, $httpResponse->json());

        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isCancelled());
        $this->assertFalse($response->isPending());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('22', $response->getCode());
        $this->assertSame('Invalid currency', $response->getMessage());
        $this->assertNull($response->getTransactionId());
        $this->assertNull($response->getTransactionReference());
        $this->assertNull($response->getVoucherCode());
        $this->assertNull($response->getVoucherSerial());
        $this->assertNull($response->getVoucherCurrency());
        $this->assertNull($response->getVoucherAmount());
        $this->assertNull($response->getVoucherExpiryDate());
        $this->assertNull($response->getVoucherCreationDate());
    }
}
