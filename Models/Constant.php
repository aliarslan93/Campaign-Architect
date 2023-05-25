<?php

namespace Models;
abstract class Constant
{
    const PRODUCTS = [
        'R01' => [
            "code" => "R01",
            "name" => "Red Widget",
            "price" => 32.95
        ],
        'G01' => [
            "code" => "G01",
            "name" => "Green Widget",
            "price" => 24.95
        ],
        'B01' => [
            "code" => "B01",
            "name" => "Blue Widget",
            "price" => 7.95
        ]
    ];

    const DELIVERY_RULES = [
        [
            "amount" => 50,
            "cost" => 4.95
        ],
        [
            "amount" => 90,
            "cost" => 2.95
        ]
    ];
}