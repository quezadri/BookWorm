<?php
#<!DOCTYPE html>
include "dbconfig.php";
#dbconfig.php allows the neccessary information to login to the db without hardcoding it into each php file.
#include "dbconfig.php";
$con = mysqli_connect($host,$username, $password, $dbname);

echo"<html lang='en'>\n";
echo"
  <head>
    <meta charset='UTF-8' />
    <meta name='viewport' content='width=device-width, initial-scale=1.0' />
    <title>Cart | BookWorm!</title>
    <link rel='stylesheet' href='style.css' />
    <link rel='preconnect' href='https://fonts.gstatic.com' />
    <link
      href='https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,300;0,400;0,500;0,600;1,100;1,200;1,300;1,400;1,500;1,600&display=swap'
      rel='stylesheet'/>
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
              <li><a href='ebooks.php'>Books</a></li>
              <li><a href='subscription.php'>BookWorm Pro</a></li>
              <li><a href=''>About</a></li>
              <li><a href=''>Contact</a></li>
              <li><a id='signIn' class='btn' href='javascript:void(0)'>Sign In</a></li>
            </ul>
          </nav>
          <a href='cart.php'>
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
    </div>

    <!-- ----------Subscription plan details------------- -->";


#SQL query that will retrieve the data we want to display on subscription page
$sql = " SELECT mtype, description, discount, mPrice FROM bookwormdb.membership ORDER BY mPrice ";
$result = mysqli_query($con, $sql);

if($result) {
  echo "<div  style = 'margin:50px' class='sub-container'>";
  while($row = mysqli_fetch_array($result)){
    $mtype = $row['mtype'];
    #description must be separated
    $description = $row['description'];
    $dArray = explode("|", $description, 3);

    $discount = $row['discount'];
    $mPrice = $row["mPrice"];
    

    
    if ($mtype <>"") {
      echo" <div class='sub-detail'>
            <h3><u>".$dArray[0]."</u></h3>
            <br>
            <ul>
                <li>- ".$dArray[1]."</li>
                <li>- ".$dArray[2]."</li>
            </ul>
            <br>
            <p> $".$mPrice."/cycle</p>
        </div>";
    }
}
  echo "</div>";
}



echo"
<!--     <div class='sub-container'>
        <div class='sub-detail'>
            <h3><u>Novice Reader</u></h3>
            <br>
            <ul>
                <li>- 2 Books per cycle</li>
                <li>- Cycles from 3 months and up</li>
            </ul>
            <br>
            <p id='price'>$8.99/cycle</p>
        </div>
        <div class='sub-detail'>
            <h3><u>Monthly Reader</u></h3>
            <br>
            <ul>
                <li>- 4 Books per cycle</li>
                <li>- Cycles from 1 month and up</li>
            </ul>
            <br>
            <p id='price'>$16.99/cycle</p>
        </div>
        <div class='sub-detail'>
            <h3><u>Daily Reader</u></h3>
            <br>
            <ul>
                <li>- 6 Books per cycle</li>
                <li>- Cycles from 1 week and up</li>
            </ul>
            <br>
            <p id='price'>$24.99/cycle</p>
        </div>
    </div> -->
    <!-- ---------------------footer------------------- -->
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
</html> ";

#Close Connection
mysqli_free_result($result);
mysqli_close($con);

?>