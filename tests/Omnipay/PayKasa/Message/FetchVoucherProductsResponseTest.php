<?php

namespace Omnipay\PayKasa\Message;

use Omnipay\Tests\TestCase;
use Omnipay\PayKasa\Model\Product;

class FetchVoucherProductsResponseTest extends TestCase
{
    /**
     * @var FetchVoucherProductsRequest
     */
    protected $request;

    public function setUp()
    {
        parent::setUp();
        $this->request = new FetchVoucherProductsRequest($this->getHttpClient(), $this->getHttpRequest());
    }

    public function testSuccess()
    {
        $httpResponse = $this->getMockHttpResponse('FetchVoucherProductsSuccess.txt');
        $response = new FetchVoucherProductsResponse($this->request, $httpResponse->json());

        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isCancelled());
        $this->assertFalse($response->isPending());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('00', $response->getCode());
        $this->assertSame('Great success', $response->getMessage());

        /** @var Product[] $products */
        $products = $response->getProducts();
        $this->assertNotEmpty($products);
        $this->assertArrayHasKey(0, $products);
        $this->assertArrayHasKey(1, $products);
        $this->assertArrayHasKey(2, $products);
        $this->assertArrayHasKey(3, $products);
        $this->assertArrayNotHasKey(4, $products);

        $this->assertInstanceOf('\Omnipay\PayKasa\Model\Product', $products[0]);
        $this->assertSame('10EUR', $products[0]->getName());

        $this->assertInstanceOf('\Omnipay\PayKasa\Model\Product', $products[1]);
        $this->assertSame('10.01EUR', $products[1]->getName());

        $this->assertInstanceOf('\Omnipay\PayKasa\Model\Product', $products[2]);
        $this->assertSame('20EUR', $products[2]->getName());

        $this->assertInstanceOf('\Omnipay\PayKasa\Model\Product', $products[3]);
        $this->assertSame('20.01EUR', $products[3]->getName());
    }

    public function testFailure()
    {
        $httpResponse = $this->getMockHttpResponse('FetchVoucherProductsFailure.txt');
        $response = new FetchVoucherProductsResponse($this->request, $httpResponse->json());

        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isCancelled());
        $this->assertFalse($response->isPending());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('40', $response->getCode());
        $this->assertSame('Your credentials could not be verified Check your api token', $response->getMessage());
        $this->assertNull($response->getProducts());
    }
}
