<?php

namespace Omnipay\PayKasa\Message;

use Guzzle\Http\Exception\BadResponseException;
use Omnipay\Common\Exception\InvalidRequestException;

/**
 * Class FetchTransactionRequest
 * @package Omnipay\PayKasa\Message
 */
class FetchTransactionRequest extends AbstractRequest
{
    /**
     * @return string
     * @throws InvalidRequestException
     */
    public function getData()
    {
        $this->validate('token');

        if ($transactionId = $this->getTransactionId()) {
            return $transactionId;
        } elseif ($transactionReference = $this->getTransactionReference()) {
            return $transactionReference;
        } else {
            throw new InvalidRequestException('The transactionId or transactionReference parameter is required');
        }
    }

    /**
     * @param string $id
     *
     * @return FetchTransactionResponse
     */
    public function sendData($id)
    {
        $uri = $this->createUri('requests/' . $id);
        $headers = $this->createHeaders();

        try {
            $response = $this->httpClient->get($uri, $headers)->send();
        } catch (BadResponseException $e) {
            $response = $e->getResponse();
        }

        return new FetchTransactionResponse($this, $response->json());
    }
}
