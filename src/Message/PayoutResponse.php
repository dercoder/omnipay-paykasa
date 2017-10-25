<?php

namespace Omnipay\PayKasa\Message;

use DateTime;
use DateTimeZone;

/**
 * Class PayoutResponse
 * @package Omnipay\PayKasa\Message
 */
class PayoutResponse extends AbstractResponse
{
    /**
     * @return null|string
     */
    public function getTransactionId()
    {
        if (isset($this->data['customer_order_id'])) {
            return (string) $this->data['customer_order_id'];
        }

        return null;
    }

    /**
     * @return null|string
     */
    public function getTransactionReference()
    {
        if (isset($this->data['transaction_id'])) {
            return (string) $this->data['transaction_id'];
        }

        return null;
    }

    /**
     * @return null|string
     */
    public function getVoucherCode()
    {
        if (isset($this->data['voucher']['code'])) {
            return (string) $this->data['voucher']['code'];
        }

        return null;
    }

    /**
     * @return null|string
     */
    public function getVoucherSerial()
    {
        if (isset($this->data['voucher']['serial'])) {
            return (string) $this->data['voucher']['serial'];
        }

        return null;
    }

    /**
     * @return null|string
     */
    public function getVoucherCurrency()
    {
        if (isset($this->data['voucher']['currency'])) {
            return (string) $this->data['voucher']['currency'];
        }

        return null;
    }

    /**
     * @return null|string
     */
    public function getVoucherAmount()
    {
        if (isset($this->data['voucher']['amount'])) {
            return (float) $this->data['voucher']['amount'];
        }

        return null;
    }

    /**
     * @return null|DateTime
     */
    public function getVoucherExpiryDate()
    {
        if (isset($this->data['voucher']['expiry_date'])) {
            return new DateTime($this->data['voucher']['expiry_date'], new DateTimeZone('UTC'));
        }

        return null;
    }

    /**
     * @return null|DateTime
     */
    public function getVoucherCreationDate()
    {
        if (isset($this->data['voucher']['created_date'])) {
            return new DateTime($this->data['voucher']['created_date'], new DateTimeZone('UTC'));
        }

        return null;
    }
}
