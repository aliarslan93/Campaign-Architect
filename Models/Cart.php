<?php

namespace Models;

class Cart
{
    /**
     * @var int
     */
    private $total = 0;

    /**
     * @var array
     */
    protected $cart_items = array();

    /**
     * @var array
     */
    protected $promotions = array();

    /**
     * @param $product_code
     * @return void
     */
    public function add($product_code)
    {
        $product = new Product();
        $this->cart_items[] = $product->getDetail($product_code);
    }

    /**
     * @return array
     */
    public function get()
    {
        return $this->cart_items;
    }

    /**
     * @param $product_code
     * @param $unit
     * @param $discount
     */
    public function addPromotion($product_code, $unit, $discount)
    {
        $this->promotions[$product_code] = array(
            'code' => $product_code,
            'unit' => $unit,
            'discount' => $discount
        );
    }

    /**
     * @param $products Product
     * @param $promotions array
     * @return boolean
     */
    public function checkPromotion()
    {
        foreach ($this->cart_items as $product) {
            if ($product instanceof Product & array_key_exists($product->code, $this->promotions)) {
                $this->promotions[$product->code]['unit']--;
                if ($this->promotions[$product->code]['unit'] > 1) {
                    return $this->checkPromotion($this->cart_items, $this->promotions);
                }
                if ($this->promotions[$product->code]['unit'] == 0) {
                    $product->setPrice(($product->price * $this->promotions[$product->code]['discount']) / 100);
                }
            }
        }
        return true;
    }

    /**
     * @return bool
     */
    public function checkoutCart()
    {
        if (empty($this->cart_items)) {
            return "Please add product ";
        }
        $this->checkPromotion();
        $this->sumTotal();
        $delivery_cost = $this->calculateDeliveryAmount($this->total);
        return $this->total += $delivery_cost;
    }

    private function sumTotal()
    {
        foreach ($this->cart_items as $cart_item) {
            $this->total += $cart_item->price;
        }
    }

    /**
     * @return false|mixed
     */
    private function calculateDeliveryAmount()
    {
        if (is_array(Constant::DELIVERY_RULES) && !empty(Constant::DELIVERY_RULES)) {
            foreach (Constant::DELIVERY_RULES as $rule) {
                if ($this->total < $rule['amount']) {
                    return $rule['cost'];
                }
            }
        }
        return false;
    }
}