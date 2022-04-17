<?php
#<!DOCTYPE html>
include "dbconfig.php";
#dbconfig.php allows the neccessary information to login to the db without hardcoding it into each php file.
#include "dbconfig.php";
$con = mysqli_connect($host,$username, $password, $dbname);
$barcode =mysqli_real_escape_string($con, $_GET['barcode']); #grabs barcode from url
#Testing code used to see the barcode passed through the previous page
#echo $barcode;

echo"<html lang='en'>\n";  
echo"
<head>
    <meta charset='UTF-8' />
    <meta name='viewport' content='width=device-width, initial-scale=1.0' />
    <title>Book-detailpage | BookWorm!</title>
    <link rel='stylesheet' href='style.css' />
    <link rel='preconnect' href='https://fonts.gstatic.com' />
    <link
      href='https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,300;0,400;0,500;0,600;1,100;1,200;1,300;1,400;1,500;1,600&display=swap'
      rel='stylesheet'
    />
    <link
      rel='stylesheet'
      href='https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'
    />
    <script src='https://kit.fontawesome.com/2496949d98.js' crossorigin='anonymous'></script>
    <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
    <script src='script.js'></script>
  </head>

  <body>
    <!------------------ Header ------------------>
    <div class='header'>
      <div class='container'>
        <div class='navbar'>
          <div class='logo'>
            <a href='index.php'>
              <img src='images/BookWormLogo.gif' alt='BookWorm-Logo' height='150' width='150'></img>
            </a>
          </div>
          <!----------  Nav Bar ------------------>
          <nav>
            <ul id='MenuItems'>
              <li><a href='index.php'>Home</a></li>
              <li><a href='ebooks.html'>Books</a></li>
              <li><a href='subscription.php'>BookWorm Pro</a></li>
              <li><a href=''>About</a></li>
              <li><a href=''>Contact</a></li>
              <li><a id='signIn' class='btn' href='javascript:void(0)'>Sign In</a></li>
            </ul>
          </nav>
          <a href='cart.html'>
            <i id='cartIcon' class='fa-solid fa-cart-shopping'></i>
          </a>
          <span class='badge' id='cartCount'>1</span>
          <img src='images/menu.png' class='menu-icon' onclick='menutoggle()' />
        </div>
      </div>
    </div>

    <!--Login modal-->
    <div id='loginModal' class='modal'>
      <form class='modal-login animate' action='javascript:void(0)' method='post'>
        <div class='login-container'>
          <span onclick='document.getElementById('loginModal').style.display='none'' class='close' title='Close Modal'>&times;</span>
          <br>
          <label for='email'><b>Email</b></label>
          <input type='email' placeholder='Enter Email' id='email' required>

          <label for='password'><b>Password</b></label>
          <input type='password' placeholder='Enter Password' id='password' required>

          <button id='loginbtn' class='btn loginbtn' type='submit'>Login</button>
        </div>
      </form>
    </div> ";

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

    echo"<!-- ---------------------footer------------------- -->
    <div class='footer'>
      <div class='container'>
        <div class='row'>
          <div class='footer-col-1'>
            <h3>Download Our App</h3>
            <p>Download App for Android and ios mobile phone.</p>
            <div class='app-logo'>
              <img src='images/Playstore.png' />
              <img src='images/Applestore.png' />
            </div>
          </div>
          <div class='footer-col-2'>
            <img src='images/BookWormLogo.gif' alt='BookWorm-Logo' height='150' width='50'></img>
            <p>
              A Better Way to Buy Books Online!
            </p>
          </div>
          <div class='footer-col-3'>
            <h3>Useful Links</h3>
            <ul>
              <li>Coupons</li>
              <li>Blog Post</li>
              <li>Return Policy</li>
              <li>Join Affiliate</li>
            </ul>
          </div>
          <div class='footer-col-4'>
            <h3>Follow us</h3>
            <ul>
              <li>Facebook</li>
              <li>Youtube</li>
              <li>Instagram</li>
              <li>Twitterr</li>
            </ul>
          </div>
        </div>
        <hr />
        <p class='copyright'>Copyright 2022 - BookWorm</p>
      </div>
    </div>
    <!-- ---------Javascript for toggle menu------------- -->
    <script>
      var MenuItems = document.getElementById('MenuItems');
      MenuItems.style.maxHeight = '0px';
      function menutoggle() {
        if (MenuItems.style.maxHeight == '0px') {
          MenuItems.style.maxHeight = '200px';
        } else {
          MenuItems.style.maxHeight = '0px';
        }
      }
    </script>
  </body>
</html>
";

#Close Connection
mysqli_free_result($result);
mysqli_close($con);
?>