<?php

namespace Omnipay\PayKasa\Message;

use Omnipay\Tests\TestCase;

class FetchTransactionRequestTest extends TestCase
{
    /**
     * @var FetchTransactionRequest
     */
    private $request;

    public function setUp()
    {
        parent::setUp();
        $this->request = new FetchTransactionRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->initialize(array(
            'token'                => 'merchant_token',
            'transactionReference' => 'VR-17135'
        ));
    }

    public function testGetData()
    {
        $this->request->setTransactionReference('VR-17135');
        $this->request->setTransactionId(null);
        $data = $this->request->getData();
        $this->assertSame('VR-17135', $data);

        $this->request->setTransactionReference(null);
        $this->request->setTransactionId('TX2229777');
        $data = $this->request->getData();
        $this->assertSame('TX2229777', $data);

        $this->request->setTransactionReference(null);
        $this->request->setTransactionId(null);
        $this->setExpectedException('Omnipay\Common\Exception\InvalidRequestException');
        $this->request->getData();
    }

    public function testSendDataSuccess()
    {
        $this->setMockHttpResponse('FetchTransactionSuccess.txt');
        $data = $this->request->getData();
        $response = $this->request->sendData($data);
        $this->assertInstanceOf('Omnipay\PayKasa\Message\FetchTransactionResponse', $response);
    }

    public function testSendDataFailure()
    {
        $this->setMockHttpResponse('FetchTransactionFailure.txt');
        $data = $this->request->getData();
        $response = $this->request->sendData($data);
        $this->assertInstanceOf('Omnipay\PayKasa\Message\FetchTransactionResponse', $response);
    }
}
