<?php

namespace Omnipay\PayKasa\Message;

use DateTime;
use DateTimeZone;

/**
 * Class PurchaseResponse
 * @package Omnipay\PayKasa\Message
 */
class PurchaseResponse extends AbstractResponse
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
     * @return null|float
     */
    public function getAmount()
    {
        if (isset($this->data['voucher_amount'])) {
            return (float) $this->data['voucher_amount'];
        }

        return null;
    }

    /**
     * @return null|string
     */
    public function getCurrency()
    {
        if (isset($this->data['voucher_currency'])) {
            return (string) $this->data['voucher_currency'];
        }

        return null;
    }

    /**
     * @return null|string
     */
    public function getIssuerName()
    {
        if (isset($this->data['issuer_name'])) {
            return (string) $this->data['issuer_name'];
        }

        return null;
    }

    /**
     * @return null|DateTime
     */
    public function getIssueDate()
    {
        if (isset($this->data['voucher_issue_date'])) {
            return new DateTime($this->data['voucher_issue_date'], new DateTimeZone('UTC'));
        }

        return null;
    }
}
