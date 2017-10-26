<?php

namespace Omnipay\PayKasa\Message;

use Omnipay\PayKasa\Model\Product;

/**
 * Class GetVoucherProductsResponse
 * @package Omnipay\PayKasa\Message
 */
class FetchVoucherProductsResponse extends AbstractResponse
{
    /**
     * @return array|null
     */
    public function getProducts()
    {
        if (!isset($this->data['voucher_products']) || !is_array($this->data['voucher_products'])) {
            return null;
        }

        $products = array();
        foreach ($this->data['voucher_products'] as $productData) {
            $product = new Product($productData);
            $sortKey = $product->getAmountInteger();
            $products[$sortKey] = $product;
        }

        ksort($products);
        return array_values($products);
    }
}
