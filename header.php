<?php
#header

echo"
  <head>
    <meta charset='UTF-8' />
    <meta name='viewport' content='width=device-width, initial-scale=1.0' />
    <title>BookWorm! | Online Bookstore</title>
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
              <li><a href='ebooks.php'>Books</a></li>
              <li><a href='subscription.php'>BookWorm Pro</a></li>
              <li><a href=''>About</a></li>
              <li><a href=''>Contact</a></li>";
  if(!isset($_SESSION["customerLoggedIn"]) or $_SESSION["customerLoggedIn"] == False  ){
             echo"<li><a id='signIn' class='btn' href='javascript:void(0)'>Sign In</a></li>";
            }
  else{
    echo"<li><a id='signIn' class='btn' href='javascript:void(0)'>My Account</a></li>";
  }

  echo "</ul></nav>";

  if(!empty($_SESSION["shopping_cart"])) {
    $cart_count = count(array_keys($_SESSION["shopping_cart"])); 
           echo"
          <a href='cart.php'>
            <i id='cartIcon' class='fa-solid fa-cart-shopping'></i>
          </a>
          <span class='badge' id='cartCount'>$cart_count</span>
          <img src='images/menu.png' class='menu-icon' onclick='menutoggle()' />
        </div>
       ";
  } else {
      echo"
      <a href='cart.php'>
        <i id='cartIcon' class='fa-solid fa-cart-shopping'></i>
      </a>
      <img src='images/menu.png' class='menu-icon' onclick='menutoggle()' />
    </div>
  ";
  }


if ($_SESSION['currentPage'] == "https://localhost/BookWorm/index.php") {      
echo"<div class='row'>
          <div class='col-2'>
            <h1>
              BookWorm!<br />
              The Online Bookstore
            </h1>
            <p>
              A Better Way to Buy Books Online!<br />
              
            </p>
            <a href='ebooks.html' class='btn'>Explore Now &#x27F6;</a>
          </div>
          <div class='col-2'>
            <img src='images/Header.png' alt='Header Pic' />
          </div>
        </div>
        
      </div>
    </div>
";
}
else{
	echo" </div>
    </div>";
}
if(!isset($_SESSION["customerLoggedIn"]) or $_SESSION["customerLoggedIn"] == False ){
echo"
    <!--Login modal-->
    <div id='loginModal' class='modal'>
      <form class='modal-login animate' action='javascript:void(0)' method='post'>
        <div class='login-container'>
          <span onclick=document.getElementById('loginModal').style.display='none' class='close' title='Close Modal'>&times;</span>
          <br>
          <label for='email'><b>Email</b></label>
          <input type='email' placeholder='Enter Email' id='email' name='email' required>

          <label for='password'><b>Password</b></label>
          <input type='password' placeholder='Enter Password' id='password' name='password' required>

          <button id='loginbtn' class='btn loginbtn' type='submit' formaction='login.php'>Login</button>
          <br>
          <label for='signup'>Don't have an account? Sign up for one <a href = 'https://localhost/BookWorm/signup.php' style='color:#ff523b;font-size:20px;font: 'Poppins'>here!</a></label>
        </div>
      </form>
    </div> ";
}
else{
	echo"
    <!--Login modal-->
    <div id='loginModal' class='modal'>
      <form class='modal-login animate' action='javascript:void(0)' method='post'>
        <div class='login-container'>
          <span onclick=document.getElementById('loginModal').style.display='none' class='close' title='Close Modal'>&times;</span>
          <br>
          <label><b>Options</b></label>
          <button id='loginbtn' class='btn loginbtn' type='submit' formaction='logout.php'>Logout</button>
          <br>
        </div>
      </form>
    </div> ";
}
    
    echo"<!-- ---------Javascript for toggle menu------------- -->
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
    </script>";


?>