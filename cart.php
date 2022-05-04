<?php
#Start the session
session_start();

$_SESSION['currentPage'] = "https://localhost/BookWorm/cart.php";

include "header.php";

if (isset($_POST['action']) && $_POST['action']=="remove"){
	if(!empty($_SESSION["shopping_cart"])) {
		foreach($_SESSION["shopping_cart"] as $key => $value) {
		  if($_POST["code"] == $key){
		  unset($_SESSION["shopping_cart"][$key]);
		  $status = "<div class='box' style='color:red;'>
		  Product is removed from your cart!</div>";
		  }
		  if(empty($_SESSION["shopping_cart"]))
		  unset($_SESSION["shopping_cart"]);
		  }		
	}
}
	
if (isset($_POST['action']) && $_POST['action']=="change"){
	foreach($_SESSION["shopping_cart"] as &$value){
	if($value['barcode'] === $_POST["code"]){
		$value['quantity'] = $_POST["quantity"];
		break; // Stop the loop after we've found the product
	}
	}
}

echo "<div class='cart'>";

if(isset($_SESSION["shopping_cart"])) {
    $total_price = 0;

	echo "<table class='table'>
	<tbody>
	<tr>
	<td></td>
	<td>BOOK TITLE</td>
	<td>QUANTITY</td>
	<td>UNIT PRICE</td>
	<td>ITEMS TOTAL</td>
	</tr>"; ?>
	<?php		
foreach ($_SESSION["shopping_cart"] as $product){
?>
<tr>
<td>
<?php echo "<img src='data:image/jpeg;base64,".base64_encode($product['image'])."' width='50' height='40' />"?>
</td>
<td><?php echo $product["title"]; ?><br />
<form method='post' action=''>
<input type='hidden' name='code' value="<?php echo $product["barcode"]; ?>" />
<input type='hidden' name='action' value="remove" />
<button type='submit' class='remove'>Remove Item</button>
</form>
</td>
<td>
<form method='post' action=''>
<input type='hidden' name='code' value="<?php echo $product["barcode"]; ?>" />
<input type='hidden' name='action' value="change" />
<select name='quantity' class='quantity' onChange="this.form.submit()">
<option <?php if($product["quantity"]==1) echo "selected";?>
value="1">1</option>
<option <?php if($product["quantity"]==2) echo "selected";?>
value="2">2</option>
<option <?php if($product["quantity"]==3) echo "selected";?>
value="3">3</option>
<option <?php if($product["quantity"]==4) echo "selected";?>
value="4">4</option>
<option <?php if($product["quantity"]==5) echo "selected";?>
value="5">5</option>
</select>
</form>
</td>
<td><?php echo "$".$product["price"]; ?></td>
<td><?php echo "$".$product["price"]*$product["quantity"]; ?></td>
</tr>
<?php
$total_price += ($product["price"]*$product["quantity"]);
}
?>
<tr>
<td colspan="5" align="right">
<strong>TOTAL: <?php echo "$".$total_price; ?></strong>
</td>
</tr>
</tbody>
</table>
<a id='checkout' class='btn' onClick='alert("Your purchase was successful!")'>Checkout</a>
  <?php
}else{
	echo "<h3>Your cart is empty!</h3>";
	}
?>
</div>

<div style="clear:both;"></div>

<div class="message_box" style="margin:10px 0px;">
<?php 

if (isset($status)) {
	echo $status; 
} else {
	echo "";
}

?>
</div>
<?php

include "footer.php";
	?>