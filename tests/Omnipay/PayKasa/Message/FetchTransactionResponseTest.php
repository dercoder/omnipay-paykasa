<?php

namespace Omnipay\PayKasa\Message;

use Omnipay\Tests\TestCase;

class FetchTransactionResponseTest extends TestCase
{
    /**
     * @var PurchaseRequest
     */
    protected $request;

    public function setUp()
    {
        parent::setUp();
        $this->request = new FetchTransactionRequest($this->getHttpClient(), $this->getHttpRequest());
    }

    public function testSuccess()
    {
        $httpResponse = $this->getMockHttpResponse('FetchTransactionSuccess.txt');
        $response = new FetchTransactionResponse($this->request, $httpResponse->json());

        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isCancelled());
        $this->assertFalse($response->isPending());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('00', $response->getCode());
        $this->assertSame('Great success', $response->getMessage());
        $this->assertSame(30033, $response->getRequestId());
        $this->assertSame('TX2229777', $response->getTransactionId());
        $this->assertSame('VI-26348', $response->getTransactionReference());
        $this->assertSame(12.43, $response->getAmount());
        $this->assertSame('EUR', $response->getCurrency());
        $this->assertSame('Successful', $response->getStatus());
        $this->assertSame('00', $response->getStatusCode());
        $this->assertSame('Great success', $response->getStatusMessage());
        $this->assertInstanceOf('DateTime', $response->getRequestDate());
        $this->assertSame('2017-10-25T16:34:22+00:00', $response->getRequestDate()->format('c'));
    }

    public function testFailure()
    {
        $httpResponse = $this->getMockHttpResponse('FetchTransactionFailure.txt');
        $response = new FetchTransactionResponse($this->request, $httpResponse->json());

        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isCancelled());
        $this->assertFalse($response->isPending());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('44', $response->getCode());
        $this->assertSame('Requested record not found', $response->getMessage());
        $this->assertNull($response->getRequestId());
        $this->assertNull($response->getTransactionId());
        $this->assertNull($response->getTransactionReference());
        $this->assertNull($response->getAmount());
        $this->assertNull($response->getCurrency());
        $this->assertNull($response->getStatus());
        $this->assertNull($response->getStatusCode());
        $this->assertNull($response->getStatusMessage());
        $this->assertNull($response->getRequestDate());
    }
}
