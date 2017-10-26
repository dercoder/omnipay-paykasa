<?php

namespace Omnipay\PayKasa\Message;

use Omnipay\Tests\TestCase;

class FetchVoucherProductsRequestTest extends TestCase
{
    /**
     * @var FetchVoucherProductsRequest
     */
    protected $request;

    public function setUp()
    {
        parent::setUp();
        $this->request = new FetchVoucherProductsRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->initialize();
    }

    public function testGetData()
    {
        $data = $this->request->getData();
        $this->assertNull($data);
    }

    public function testSendDataSuccess()
    {
        $this->setMockHttpResponse('FetchVoucherProductsSuccess.txt');
        $data = $this->request->getData();
        $response = $this->request->sendData($data);
        $this->assertInstanceOf('Omnipay\PayKasa\Message\FetchVoucherProductsResponse', $response);
    }

    public function testSendDataFailure()
    {
        $this->setMockHttpResponse('FetchVoucherProductsFailure.txt');
        $data = $this->request->getData();
        $response = $this->request->sendData($data);
        $this->assertInstanceOf('Omnipay\PayKasa\Message\FetchVoucherProductsResponse', $response);
    }
}
