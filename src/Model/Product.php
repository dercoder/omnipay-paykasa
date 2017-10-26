<?php

namespace Omnipay\PayKasa\Model;

/**
 * Class Product
 * @package Omnipay\PayKasa\Model
 */
class Product
{
    /**
     * @var array
     */
    private $data = array();

    /**
     * Product constructor.
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
    public function getName()
    {
        if (isset($this->data['name'])) {
            return (string) $this->data['name'];
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
     * @return null|string
     */
    public function getVoucherType()
    {
        if (isset($this->data['voucher_type'])) {
            return (string) $this->data['voucher_type'];
        }

        return null;
    }
}
