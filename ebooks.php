<?php
session_start();

include "dbconfig.php";

$_SESSION['currentPage'] = "https://localhost/BookWorm/ebooks.php";

include "header.php";

$con = mysqli_connect($host,$username, $password, $dbname);

$status = "";
if (isset($_POST['code']) && $_POST['code']!=""){
    $code = $_POST['code'];
    $result = mysqli_query(
    $con,
    "SELECT * FROM `books` WHERE `barcode`='$code'"
    );
    $row = mysqli_fetch_assoc($result);
    $title = $row['title'];
    $code = $row['barcode'];
    $price = $row['price'];
    $image = $row['image'];
    
    $cartArray = array(
        $code=>array(
        'title'=>$title,
        'barcode'=>$code,
        'price'=>$price,
        'quantity'=>1,
        'image'=>$image)
    );
    
    if(empty($_SESSION["shopping_cart"])) {
        $_SESSION["shopping_cart"] = $cartArray;
        $status = "<div class='box'>Product is added to your cart!</div>";
    }else{
        $array_keys = array_keys($_SESSION["shopping_cart"]);
        if(in_array($code,$array_keys)) {
        $status = "<div class='box' style='color:red;'>
        Product is already added to your cart!</div>";	
        } else {
        $_SESSION["shopping_cart"] = array_merge(
        $_SESSION["shopping_cart"],
        $cartArray
        );
        $status = "<div class='box'>Product is added to your cart!</div>";
        }
    
        }
    }

    $result = mysqli_query($con,"SELECT * FROM `books`");
    while($row = mysqli_fetch_assoc($result)){
        echo "<div class='product_wrapper'>
        <form method='post' action=''>
        <input type='hidden' name='code' value=".$row['barcode']." />
        <div class='image'><a href='book-detail.php?barcode=".$row['barcode']."'><img src='data:image/jpeg;base64,".base64_encode($row['image'])."' width='250px' height='300px' /></div>
        <div class='name'>".$row['title']."</div>
        <div class='price'>$".$row['price']."</div>
        <button type='submit' class='buy'>Add To Cart</button>
        </form>
        </div>";
    }
    mysqli_close($con);

    echo "<div style='clear:both;'></div>

    <div class='message_box' style='margin:10px 0px;'>
    
        $status"

?>