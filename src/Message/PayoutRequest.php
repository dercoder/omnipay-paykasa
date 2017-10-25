<?php

namespace Omnipay\PayKasa\Message;

use Guzzle\Http\Exception\BadResponseException;

/**
 * Class PayoutRequest
 * @package Omnipay\PayKasa\Message
 */
class PayoutRequest extends AbstractRequest
{
    /**
     * @return string
     */
    public function getVoucherType()
    {
        return $this->getParameter('voucherType');
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function setVoucherType($value)
    {
        return $this->setParameter('voucherType', $value);
    }

    /**
     * @return array
     */
    public function getData()
    {
        $this->validate(
            'token',
            'transactionId',
            'currency',
            'amount',
            'voucherType'
        );

        return [
            'customer_order_id' => $this->getTransactionId(),
            'currency'          => $this->getCurrency(),
            'amount'            => $this->getAmount(),
            'voucher_type'      => $this->getVoucherType(),
        ];
    }

    /**
     * @param array $data
     *
     * @return PayoutResponse
     */
    public function sendData($data)
    {
        $uri = $this->createUri('vouchers');
        $headers = $this->createHeaders();

        try {
            $response = $this->httpClient->post($uri, $headers, $data)->send();
        } catch (BadResponseException $e) {
            $response = $e->getResponse();
        }

        return new PayoutResponse($this, $response->json());
    }
}
