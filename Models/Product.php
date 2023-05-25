<?php

namespace Models;

class Product
{
    public $code;
    public $name;
    public $price;

    public function __construct($code = null, $name = null, $price = null)
    {
        $this->code = $code;
        $this->name = $name;
        $this->price = $price;
    }

    /**
     * @param $productCode
     * @return Product|string
     */
    public function getDetail($productCode)
    {
        if (!array_key_exists($productCode, Constant::PRODUCTS)) {
            return "Product Not Defined";
        }
        return new Product(Constant::PRODUCTS[$productCode]['code'], Constant::PRODUCTS[$productCode]['name'], Constant::PRODUCTS[$productCode]['price']);
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

}