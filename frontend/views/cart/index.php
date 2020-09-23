<?php
use \yii\helpers\ArrayHelper;
use yii\helpers\Html;
if($products) {
?>
<div id="page">
      <table id="cart">
        <thead>
          <tr>
            <th class="first"></th>
            <th class="second">Qty</th>
            <th class="third">Product</th>
            <th class="fourth">Price</th>
            <th class="fifth">&nbsp;</th>
          </tr>
        </thead>
        <tbody>
            <?php
                    foreach($products as $product) { //echo "<pre>"; print_r($product); die; ?>
                        <tr class="productitm">
                            <td><img src="<?php echo $product->image; ?>" class="thumb"></td>
                            <td><?php echo ArrayHelper::getValue($cartItems,$product->id); ?></td>
                            <td><?php echo $product->name; ?></td>
                            <td><?php echo $product->price; ?></td>
                        </tr>              
                    <?php 
                }
            ?>
          <!-- shopping cart contents -->
          <!-- tax + subtotal -->
          <tr class="totalprice">
            <td class="light">Total:</td>
            <td colspan="2">&nbsp;</td>
            <td colspan="2"><span class="thick"><?php echo array_sum(ArrayHelper::getColumn($products,'price')); ?></span></td>
          </tr>
          
          <!-- checkout btn -->
          <tr class="checkoutrow">
            <td colspan="5" class="checkout"><button onclick="location.href='/checkout/'" id="submitbtn">Checkout Now!</button></td>
          </tr>
        </tbody>
      </table>
    </div>
            <?php } else {
                echo "No Products Found In Your Cart.";
            } ?>