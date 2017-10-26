<?php

namespace Omnipay\PayKasa\Message;

use DateTime;
use DateTimeZone;
use Omnipay\PayKasa\Model\Voucher;

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
     * @return null|Voucher
     */
    public function getVoucher()
    {
        if (isset($this->data['voucher'])) {
            return new Voucher($this->data['voucher']);
        }

        return null;
    }
}
