<?php

namespace Omnipay\PayKasa\Message;

use DateTime;
use DateTimeZone;

/**
 * Class FetchTransactionResponse
 * @package Omnipay\PayKasa\Message
 */
class FetchTransactionResponse extends AbstractResponse
{
    /**
     * @return null|string
     */
    public function getCode()
    {
        if ($this->getStatusCode() !== null) {
            return $this->getStatusCode();
        }

        return parent::getCode();
    }

    /**
     * @return null|string
     */
    public function getMessage()
    {
        if ($this->getStatusCode() !== null) {
            return $this->getStatusMessage();
        }

        return parent::getMessage();
    }

    /**
     * @return null|string
     */
    public function getRequestId()
    {
        if (isset($this->data['transaction_request']['id'])) {
            return (int) $this->data['transaction_request']['id'];
        }

        return null;
    }

    /**
     * @return null|DateTime
     */
    public function getRequestDate()
    {
        if (isset($this->data['transaction_request']['requestDate'])) {
            return new DateTime($this->data['transaction_request']['requestDate'], new DateTimeZone('UTC'));
        }

        return null;
    }

    /**
     * @return null|string
     */
    public function getTransactionId()
    {
        if (isset($this->data['transaction_request']['customerOrderId'])) {
            return (string) $this->data['transaction_request']['customerOrderId'];
        }

        return null;
    }

    /**
     * @return null|string
     */
    public function getTransactionReference()
    {
        if (isset($this->data['transaction_request']['transactionId'])) {
            return (string) $this->data['transaction_request']['transactionId'];
        }

        return null;
    }

    /**
     * @return null|float
     */
    public function getAmount()
    {
        if (isset($this->data['transaction_request']['amount'])) {
            return (float) $this->data['transaction_request']['amount'];
        }

        return null;
    }

    /**
     * @return null|string
     */
    public function getCurrency()
    {
        if (isset($this->data['transaction_request']['currency'])) {
            return (string) $this->data['transaction_request']['currency'];
        }

        return null;
    }

    /**
     * @return null|string
     */
    public function getStatus()
    {
        if (isset($this->data['transaction_request']['status'])) {
            return (string) $this->data['transaction_request']['status'];
        }

        return null;
    }

    /**
     * @return null|string
     */
    public function getStatusCode()
    {
        if (isset($this->data['transaction_request']['statusCode'])) {
            return (string) $this->data['transaction_request']['statusCode'];
        }

        return null;
    }

    /**
     * @return null|string
     */
    public function getStatusMessage()
    {
        if (isset($this->data['transaction_request']['statusMessage'])) {
            return (string) $this->data['transaction_request']['statusMessage'];
        }

        return null;
    }
}
