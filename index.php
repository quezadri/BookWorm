<?php
#Start the session
session_start();

#$_SESSION['customerLoggedIn'] = False;

#<!DOCTYPE html>
include "dbconfig.php";
#dbconfig.php allows the neccessary information to login to the db without hardcoding it into each php file.
#include "dbconfig.php";
$con = mysqli_connect($host,$username, $password, $dbname);
$_SESSION['currentPage'] = "https://localhost/BookWorm/index.php";

echo"<html lang='en'>\n";  
#Check for login errors
if(isset($_SESSION["loginError"]) AND $_SESSION["loginError"] == True  ){
    $_SESSION["loginError"] = False;
    echo'<script>alert("Incorrect Login. Please check your email and password.")</script>';

            }


include "header.php";


echo"<!----------------featured categories -------------------->";
#SQL query that will retrieve the data from dB
$sql = " SELECT barcode, image FROM bookwormdb.books ORDER BY rand() LIMIT 3";
$result = mysqli_query($con, $sql);

if($result) {
  echo "<div class='categories'>
      <div class='small-container'>
        <div class='row'>";
  $count = 1;
  while($row = mysqli_fetch_array($result)){
    $barcode = $row['barcode'];
    $image = $row['image'];


#echo"<img src='data:image/jpeg;base64,".base64_encode($img)."'/>";
    
    if ($barcode <>"") {
      echo" <div class='col-3'>
            <img src='data:image/jpeg;base64,".base64_encode($image)."' alt='Book ".$count."' />
          </div>
          ";
    }
    $count = $count +1;
}
  echo "</div>";
}


  /*  <div class="categories">
      <div class="small-container">
        <div class="row">
          


          <div class="col-3">
            <img src="images/Book1.jpeg" alt="Book 1" />
          </div>
          <div class="col-3">
            <img src="images/Book2.webp" alt="Book 2" />
          </div>
          <div class="col-3">
            <img src="images/Book3.jpeg" alt="Book 3" />
          </div>



        </div>
      </div>
    </div>*/


echo" <!----------------Featured Books -------------------->";
#SQL query that will retrieve the data from dB
$sql2 = " SELECT barcode, image, title, rating, price FROM bookwormdb.books ORDER BY rand() DESC LIMIT 8";
$result2 = mysqli_query($con, $sql2);

if($result2) {
  echo "<div class='small-container'>
      <h2 class='title'>Featured Books</h2>
      <div class='row'>
        ";
  #$count = 1;
  while($row = mysqli_fetch_array($result2)){
    $barcode = $row['barcode'];
    $image = $row['image'];
    $title = $row['title'];
    $rating = $row['rating'];
    $price = $row['price'];


#echo"<img src='data:image/jpeg;base64,".base64_encode($img)."'/>";
    
    if($barcode <>"") {
      echo" <div class='col-4'>
          <a href='book-detail.php?barcode=".$barcode."'>
            <img src='data:image/jpeg;base64,".base64_encode($image)."' alt='Book ".$count."'/></a>
          <a href='book-detail.php?barcode=".$barcode."'> <h4>".$title."</h4></a> "; 
      #Rating
       echo"<div class='rating'>";
        for($x = 0; $x < 5; $x++){
          if (floor($rating/2)-$x>=1 )
            {echo"<i class='fa fa-star'></i>";}
          elseif (($rating/2)-$x > 0) 
            {echo"<i class='fa fa-star-half-o'></i>";  }
          else
            {echo"<i class='fa fa-star-o'></i>";}
        }
        echo"</div>";
        echo"<p>$".$price."</p>";


      echo"</div>";
    }
    $count = $count +1;
}
  echo " </div>
        </div>
    </div>";
}



   /* <div class="small-container">
      <h2 class="title">Featured Titles</h2>
      <div class="row">


        <div class="col-4">
          <a href="book-detail.html">
            <img src="images/Book4.jpeg" alt="Book 4"
          /></a>
          <a href="book-detail.html"> <h4>Later</h4></a>
          <div class="rating">
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star-o"></i>
          </div>
          <p>$9.99</p>
        </div>
        <div class="col-4">
          <img src="images/Book5.jpeg" alt="Book 5" />
          <h4>March: Book One</h4>
          <div class="rating">
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
           
          </div>
          <p>$19.75</p>
        </div>
        <div class="col-4">
          <img src="images/Book6.jpeg" alt="Book 6" />
          <h4>Will</h4>
          <div class="rating">
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star-half-o"></i>
          </div>
          <p>$14.99</p>
        </div>
        <div class="col-4">
          <img src="images/Book7.jpeg" alt="Book 7" />
          <h4>The Hunger Games</h4>
          <div class="rating">
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star-o"></i>
          </div>
          <p>$7.99</p>
        </div>
      </div>*/

echo" <!---------------- Featured Author Stephen King -------------------->";
#SQL query that will retrieve the data from dB
$sql3 = " SELECT barcode, image, title, rating, price, author FROM bookwormdb.books WHERE author = 'Stephen King' ORDER BY title, price DESC LIMIT 4";
$result3 = mysqli_query($con, $sql3);

if($result2) {
  echo "<div class='small-container'>
      <h2 class='title'>Featured Author: Stephen King</h2>
      <div class='row'>
        ";
  #$count = 1;
  while($row = mysqli_fetch_array($result3)){
    $barcode = $row['barcode'];
    $image = $row['image'];
    $title = $row['title'];
    $rating = $row['rating'];
    $price = $row['price'];


#echo"<img src='data:image/jpeg;base64,".base64_encode($img)."'/>";
    
    if($barcode <>"") {
      echo" <div class='col-4'>
          <a href='book-detail.php?barcode=".$barcode."' method = 'post'>
            <img src='data:image/jpeg;base64,".base64_encode($image)."' alt='Book ".$count."'/></a>
          <a href='book-detail.php=".$barcode."' method = 'post'> <h4 >".$title."</h4></a> "; 
      #Rating
       echo"<div class='rating'>";
        for($x = 0; $x < 5; $x++){
          if (floor($rating/2)-$x>=1 )
            {echo"<i class='fa fa-star'></i>";}
          elseif (($rating/2)-$x > 0) 
            {echo"<i class='fa fa-star-half-o'></i>";  }
          else
            {echo"<i class='fa fa-star-o'></i>";}
        }
        echo"</div>";
        echo"<p>$".$price."</p>";


      echo"</div>";
    }
    $count = $count +1;
}
  echo " </div>
        </div>
    </div>";
}



      /*<h2 class="title">Bestsellers</h2>
      <div class="row">
        <div class="col-4">
          <img src="images/Book8.jpeg" alt="Book 8" />
          <h4>The Paris Apartment</h4>
          <div class="rating">
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star-o"></i>
          </div>
          <p>$15.99</p>
        </div>
        <div class="col-4">
          <img src="images/Book9.jpeg" alt="Book 9" />
          <h4>Educated</h4>
          <div class="rating">
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star-half-o"></i>
            <i class="fa fa-star-o"></i>
          </div>
          <p>$12.99</p>
        </div>
        <div class="col-4">
          <img src="images/Book10.jpeg" alt="Book 10" />
          <h4>Other People's Clothes</h4>
          <div class="rating">
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star-half-o"></i>
          </div>
          <p>$13.99</p>
        </div>
        <div class="col-4">
          <img src="images/Book11.jpeg" alt="Book 11" />
          <h4>One by One</h4>
          <div class="rating">
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star-o"></i>
          </div>
          <p>$13.95</p>
        </div>
      </div>
      <div class="row">
        <div class="col-4">
          <img src="images/Book12.jpeg" alt="Book 12" />
          <h4>The Dark Queens: The Bloody Rivalry That Forged the Medieval World</h4>
          <div class="rating">
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star-o"></i>
          </div>
          <p>$9.99</p>
        </div>
        <div class="col-4">
          <img src="images/Book13.jpeg" alt="Book 13" />
          <h4>Fox and I: An Uncommon Friendship</h4>
          <div class="rating">
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star-half-o"></i>
            <i class="fa fa-star-o"></i>
          </div>
          <p>$14.99</p>
        </div>
        <div class="col-4">
          <img src="images/Book14.jpeg" alt="Book 14" />
          <h4>Missing: A Memoir</h4>
          <div class="rating">
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star-half-o"></i>
          </div>
          <p>$8.99</p>
        </div>
        <div class="col-4">
          <img src="images/Book15.jpeg" alt="Book 15" />
          <h4>The Alchemist</h4>
          <div class="rating">
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star-o"></i>
          </div>
          <p>$10.95</p>
        </div>
      </div>
    </div>
*/
 echo "   
    <!------------------offer ------------>
    <div class='offer'>
      <div class='small-container'>
        <div class='row'>
          <div class='col-2'>
            <img src='images/Offer.jpeg' class='offer-img' />
          </div>
          <div class='col-2'>
            <p>Exclusively on BookWorm!</p>
            <br />
            <h2>The Tobacco Wives</h2>
            <br />
            <small>
                Shedding light on the hidden history of women’s 
                activism during the post-war period, at its heart, 
                The Tobacco Wives is a deeply human, emotionally satisfying, 
                and dramatic novel about the power of female connection and 
                the importance of seeking truth.
            </small>
            <a href='#' class='btn'>Buy Now &#8594;</a>
          </div>
        </div>
      </div>
    </div>
    <!-- ---------------testimonial-------------------->
    <div class='testimonial'>
      <div class='small-container'>
        <div div class='row'>
          <div class='col-3'>
            <i class='fa fa-quote-left'></i>
            <p>
              A beautifully rendered portrait of a young woman finding her courage and her voice.
            </p>
            <div class='rating'>
              <i class='fa fa-star'></i>
              <i class='fa fa-star'></i>
              <i class='fa fa-star'></i>
              <i class='fa fa-star'></i>
              <i class='fa fa-star-o'></i>
            </div>
            <img src='images/Lisa.jpeg' alt='Lisa' />
            <h3> - Lisa Wingate, #1 New York Times bestselling author</h3>
          </div>
          <div class='col-3'>
            <i class='fa fa-quote-left'></i>
            <p>
              This is a story of courage, of women willing to take a stand in the face of corporate greed, and most definitely a tale for our times.
            </p>
            <div class='rating'>
              <i class='fa fa-star'></i>
              <i class='fa fa-star'></i>
              <i class='fa fa-star'></i>
              <i class='fa fa-star'></i>
              <i class='fa fa-star-o'></i>
            </div>
            <img src='images/Fiona.jpeg' alt='Fiona' />
            <h3> - Fiona Davis, #1 New York Times bestselling author</h3>
          </div>
          <div class='col-3'>
            <i class='fa fa-quote-left'></i>
            <p>
              Adele Myers brings mid-century North Carolina vividly to life in her impressive, beautifully detailed debut novel, The Tobacco Wives, a suspenseful coming-of-age story of a brave young woman’s search for dangerous truths obscured by corporate deceit and betrayal.
            </p>
            <div class='rating'>
              <i class='fa fa-star'></i>
              <i class='fa fa-star'></i>
              <i class='fa fa-star'></i>
              <i class='fa fa-star'></i>
              <i class='fa fa-star-o'></i>
            </div>
            <img src='images/Jen.jpeg' alt='Jen' />
            <h3> - Jennifer Chiaverini, #1 New York Times bestselling author</h3>
          </div>
        </div>
      </div>
    </div>
    <!-- ---------------------publishers------------------- -->
    <div class='publishers'>
      <div class='small-container'>
        <div class='row'>
          <div class='col-5'>
            <img src='images/scholastic.jpeg' />
          </div>
          <div class='col-5'>
            <img src='images/chronicle.png' />
          </div>
          <div class='col-5'>
            <img src='images/candle.png' />
          </div>
          <div class='col-5'>
            <img src='images/pearson.png' />
          </div>
          <div class='col-5'>
            <img src='images/nyt.jpeg' />
          </div>
        </div>
      </div>
    </div>";
include('footer.php');      
     echo"
  </body>
</html>";

#Close Connection
mysqli_free_result($result);
mysqli_close($con);
?>