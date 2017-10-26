<?php

namespace Omnipay\PayKasa\Model;

use DateTime;
use DateTimeZone;

/**
 * Class Voucher
 * @package Omnipay\PayKasa\Model
 */
class Voucher
{
    /**
     * @var array
     */
    private $data = array();

    /**
     * Voucher constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @return null|string
     */
    public function getCode()
    {
        if (isset($this->data['code'])) {
            return (string) $this->data['code'];
        }

        return null;
    }

    /**
     * @return null|string
     */
    public function getSerial()
    {
        if (isset($this->data['serial'])) {
            return (string) $this->data['serial'];
        }

        return null;
    }

    /**
     * @return null|float
     */
    public function getAmount()
    {
        if (isset($this->data['amount'])) {
            return (float) $this->data['amount'];
        }

        return null;
    }

    /**
     * @return integer
     */
    public function getAmountInteger()
    {
        if (isset($this->data['amount'])) {
            return (int) round($this->getAmount() * 100);
        }

        return null;
    }

    /**
     * @return null|string
     */
    public function getCurrency()
    {
        if (isset($this->data['currency'])) {
            return (string) $this->data['currency'];
        }

        return null;
    }

    /**
     * @return null|DateTime
     */
    public function getExpiryDate()
    {
        if (isset($this->data['expiry_date'])) {
            return new DateTime($this->data['expiry_date'], new DateTimeZone('UTC'));
        }

        return null;
    }

    /**
     * @return null|DateTime
     */
    public function getCreationDate()
    {
        if (isset($this->data['created_date'])) {
            return new DateTime($this->data['created_date'], new DateTimeZone('UTC'));
        }

        return null;
    }
}
