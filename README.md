# architect-labs
<table>
<thead>
<tr>
<th>Product</th>
<th>Code</th>
<th>Price</th>
</tr>
</thead>
<tbody>
<tr>
<td>Red Widget</td>
<td>R01</td>
<td>$32.95</td>
</tr>
<tr>
<td>Green Widget</td>
<td>G01</td>
<td>$24.95</td>
</tr>
<tr>
<td>Blue Widget</td>
<td>B01</td>
<td>$7.95</td>
</tr>
</tbody>
</table>
To incentivise customers to spend more, delivery costs are reduced based on the amount 
spent. Orders under $50 cost $4.95. For orders under $90, delivery costs $2.95. Orders of 
$90 or more have free delivery.
They are also experimenting with special offers. The initial offer will be “buy one red widget, 
get the second half price”.

    define( 'PRODUCTS', array(
    	   'R01' => array(
    	   	    "code"  => "R01",
    	   	    "name"  => "Red Widget",
    	   	    "price" => 32.95
    	   ),
    	   'G01' => array(
    	   	    "code"  => "G01",
    	   	    "name"  => "Green Widget",
    	   	    "price" => 24.95
    	   ),
    	   'B01' => array(
    	        "code"  => "B01",
    	        "name"  => "Blue Widget",
    	        "price" => 7.95
    	   )
               ));
    define( 'DELIVERY_RULES', 
        array(
            array(
          	    "amount" => 50,
          	    "cost"      => 4.95
            ),
            array(
          	    "amount" => 90,
          	    "cost"      => 2.95
            ),
          ) 
        );

# Add Basket Item

    $basket = new Basket();
    $basket->add( 'PRODUCT_CODE' );

# Add Basket Example

    $basket = new Basket();
    $basket->add( 'R01' );

# Add Promotion
    buy one red widget,get the second half price  
    PRODUCT_CODE
    $basket->addPromotion( 'PRODUCT_CODE', DISCOUNT_UNIT, DISCOUNT_PERCENT );

# Promotion Example
    //buy one red widget,get the second half price
    $basket->addPromotion( 'R01', 2, 50 );

# Test Case
<table>
<thead>
<tr>
<th>Products</th>
<th>Total</th>
</tr>
</thead>
<tbody>
<tr>
<td>B01, G01</td>
<td>$37.85</td>
</tr>
<tr>
<td>R01, R01</td>
<td>$54.37</td>
</tr>
<tr>
<td>R01, G01</td>
<td>$60.85</td>
</tr>
<tr>
<td>B01, B01, R01, R01, R01</td>
<td>$98.27</td>
</tr>
</tbody>
</table>