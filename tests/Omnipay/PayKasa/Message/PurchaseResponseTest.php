<?php

namespace Omnipay\PayKasa\Message;

use Omnipay\Tests\TestCase;

class PurchaseResponseTest extends TestCase
{
    /**
     * @var PurchaseRequest
     */
    protected $request;

    public function setUp()
    {
        parent::setUp();
        $this->request = new PurchaseRequest($this->getHttpClient(), $this->getHttpRequest());
    }

    public function testSuccess()
    {
        $httpResponse = $this->getMockHttpResponse('PurchaseSuccess.txt');
        $response = new PurchaseResponse($this->request, $httpResponse->json());

        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isCancelled());
        $this->assertFalse($response->isPending());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('00', $response->getCode());
        $this->assertSame('Great success', $response->getMessage());
        $this->assertSame('TX2229777', $response->getTransactionId());
        $this->assertSame('VR-17135', $response->getTransactionReference());
        $this->assertSame(12.43, $response->getAmount());
        $this->assertSame('EUR', $response->getCurrency());
        $this->assertSame('XN5zj58q', $response->getIssuerName());
        $this->assertInstanceOf('DateTime', $response->getIssueDate());
        $this->assertSame('2017-10-25T14:55:12+00:00', $response->getIssueDate()->format('c'));
    }

    public function testFailure()
    {
        $httpResponse = $this->getMockHttpResponse('PurchaseFailure.txt');
        $response = new PurchaseResponse($this->request, $httpResponse->json());

        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isCancelled());
        $this->assertFalse($response->isPending());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('31', $response->getCode());
        $this->assertSame('Invalid voucher code', $response->getMessage());
        $this->assertNull($response->getTransactionId());
        $this->assertNull($response->getTransactionReference());
        $this->assertNull($response->getAmount());
        $this->assertNull($response->getCurrency());
        $this->assertNull($response->getIssuerName());
        $this->assertNull($response->getIssueDate());
    }
}
