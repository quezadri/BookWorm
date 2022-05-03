<?php
#Start the session
session_start();
#<!DOCTYPE html>
include "dbconfig.php";
#dbconfig.php allows the neccessary information to login to the db without hardcoding it into each php file.
#include "dbconfig.php";
$con = mysqli_connect($host,$username, $password, $dbname);
$barcode =mysqli_real_escape_string($con, $_GET['barcode']); #grabs barcode from url
#Testing code used to see the barcode passed through the previous page
#echo $barcode;

$_SESSION['currentPage'] = "https://localhost/BookWorm/book-detail.php?barcode=$barcode";

#Check for login errors
if(isset($_SESSION["loginError"]) AND $_SESSION["loginError"] == True  ){
    $_SESSION["loginError"] = False;
    echo'<script>alert("Incorrect Login. Please check your email and password.")</script>';
}
echo"<html lang='en'>\n";  
include "header.php";

    echo"<!-- ----------single product details--------------->";
#SQL query that will retrieve the data from dB
$sql = " SELECT image, title, author, genre, price, book_format, description  FROM bookwormdb.books WHERE barcode = '".$barcode."'";
$result = mysqli_query($con, $sql);
$count = 1;
if($result) {
  echo "<div class='small-container single-product'>
      <div class='row'>";
  
  while($row = mysqli_fetch_array($result)){
    $image = $row['image'];
    $title = $row['title'];
    $author = $row['author'];
    $genre = $row['genre'];
    $price = $row['price'];
    $book_format = $row['book_format'];
    $description = $row['description'];

#Separates the description into an array or individual paragraphs
    $dArray = explode("|",$description);

#Decides which type the book is based on book-format column
    $book_type = " ";
    if($book_format == "p"){
      $book_type = "PaperBack";
    }
    elseif($book_format == "h"){
      $book_type = "HardCover";
    }
    elseif($book_format == "a"){
      $book_type = "AudioBook";
    }
    elseif($book_format == "e"){
      $book_type = "E-book";
    }

    #Expected to run once, but kept code same as others
    if ($barcode <>"") {
      echo" <div class='col-2'>
            <img src='data:image/jpeg;base64,".base64_encode($image)."' alt='Book ".$count."' />
          </div>
          ";
      echo" <div class='col-2'>
          <p>Home / ".$book_type."</p>
          <h1>".$title." by ".$author."</h1>
          <h4>$".$price."</h4>
          <input type='number' value='1' />
          <a href='' class='btn'>Add To Cart</a>
          <h3>Book Details <i class='fa fa-indent'></i></h3>
          <br />
      ";
   #For loop, that grabs description array and creates <P> element for each
   for($x = 0; $x <count($dArray); $x++){
    echo"
<p>".$dArray[$x]."</p>
    ";
    if($x+1 == count($dArray)){
      echo"&nbsp;";
    }
   }


    }



    $count = $count + 1;
}
  echo "</div>
      </div>
    </div>";
}


 /*   <div class="small-container single-product">
      <div class="row">
        <div class="col-2">
          <img src="images/Book4.jpeg" alt="Book4" width="68%" />
        </div>
        <div class="col-2">
          <p>Home / Ebook</p>
          <h1>Later by STEPHEN KING</h1>
          <h4>$9.99</h4>
          <input type="number" value="1" />
          <a href="" class="btn">Add To Cart</a>
          <h3>Book Details <i class="fa fa-indent"></i></h3>
          <br />
          <p>
            The son of a struggling single mother, Jamie Conklin just wants an ordinary
            childhood. But Jamie is no ordinary child. Born with an unnatural ability his mom
            urges him to keep secret, Jamie can see what no one else can see and learn what 
            no one else can learn. But the cost of using this ability is higher than Jamie 
            can imagine as he discovers when an NYPD detective draws him into the pursuit of 
            a killer who has threatened to strike from beyond the grave.
            </p>
            &nbsp;
            <p>
            LATER is Stephen King at his finest, a terrifying and touching story of innocence 
            lost and the trials that test our sense of right and wrong. With echoes of King’s 
            classic novel It, LATER is a powerful, haunting, unforgettable exploration of
            what it takes to stand up to evil in all the faces it wears.
        
          </p>
        </div>
      </div>
    </div>
*/
#SQL query that will retrieve the data from dB and display under related
$sql2 = " SELECT barcode, image, title, rating, price FROM bookwormdb.books WHERE author = '".$author."' or genre = '".$genre."' ORDER BY rand() DESC LIMIT 4";
$result2 = mysqli_query($con, $sql2);

if($result2) {
  echo "<!-- -------------title----------------- -->
    <div class='small-container'>
      <div class='row row-2'>
        <h2>Related Books</h2>
        <p>View More</p>
      </div>
    </div>
     <!-- --------------Product-------------- -->
    <div class='small-container'>
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
    </div>";
}




/*
    <!-- -------------title----------------- -->
    <div class="small-container">
      <div class="row row-2">
        <h2>Related Books</h2>
        <p>View More</p>
      </div>
    </div>
    <!-- --------------Product-------------- -->
    <div class="small-container">
      <div class="row">
        <div class="col-4">
          <img src="images/BookSug1.jpeg" alt="Book Sug1" />
          <h4>Misery: A Novel</h4>
          <div class="rating">
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star-o"></i>
          </div>
          <p>$14.99</p>
        </div>
        <div class="col-4">
          <img src="images/BookSug2.jpeg" alt="Book Sug2" />
          <h4>Watership Down</h4>
          <div class="rating">
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star-half-o"></i>
            <i class="fa fa-star-o"></i>
          </div>
          <p>$13.99</p>
        </div>
        <div class="col-4">
          <img src="images/BookSug3.jpeg" alt="Book Sug3" />
          <h4>The Shining</h4>
          <div class="rating">
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star-half-o"></i>
          </div>
          <p>$15.99</p>
        </div>
        <div class="col-4">
          <img src="images/BookSug4.jpeg" alt="Book Sug4" />
          <h4>The Passage</h4>
          <div class="rating">
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star-o"></i>
          </div>
          <p>$14.99</p>
        </div>
      </div>
    </div>*/
include 'footer.php';
echo"</body>
  </html>";

#Close Connection
mysqli_free_result($result);
mysqli_close($con);
?>