<?php

namespace Omnipay\PayKasa\Message;

use Guzzle\Http\Exception\BadResponseException;

/**
 * Class GetVoucherProductsRequest
 * @package Omnipay\PayKasa\Message
 */
class FetchVoucherProductsRequest extends AbstractRequest
{
    /**
     * @return null
     */
    public function getData()
    {
        return null;
    }

    /**
     * @param array $data
     *
     * @return FetchVoucherProductsResponse
     */
    public function sendData($data)
    {
        $uri = $this->createUri('voucher_products');
        $headers = $this->createHeaders();

        try {
            $response = $this->httpClient->get($uri, $headers, $data)->send();
        } catch (BadResponseException $e) {
            $response = $e->getResponse();
        }

        return new FetchVoucherProductsResponse($this, $response->json());
    }
}
