<?php
#Start the session
session_start();

#$_SESSION['customerLoggedIn'] = False;

#<!DOCTYPE html>
include "dbconfig.php";
#dbconfig.php allows the neccessary information to login to the db without hardcoding it into each php file.
#include "dbconfig.php";
$con = mysqli_connect($host,$username, $password, $dbname);
$_SESSION['currentPage'] = "https://localhost/BookWorm/signup.php";

echo"<html lang='en'>\n";  
#Check for login errors
if(isset($_SESSION["loginError"]) AND $_SESSION["loginError"] == True  ){
    $_SESSION["loginError"] = False;
    echo'<script>alert("Incorrect Login. Please check your email and password.")</script>';
            }
#Check for signup errors
if(isset($_SESSION["signupError"]) AND $_SESSION["signupError"] == True  ){
    $_SESSION["signupError"] = False;
    echo'<script>alert("Sign up Failed! The given email is already in the system!")</script>';
            }


include "header.php";
#--------------------content--------------------------------#
echo"<div style='text-align:center'>
<form id = 'signupform' style='width:30%;margin:0 auto' method='post' >
 <br>
          <label for='email'><b>Email</b></label>
          <input type='email' placeholder='Enter Email' id='email' name='email' maxlength='30' required>

          <label for='password'><b>Password</b></label>
          <input type='password' placeholder='Enter Password' id='password' name='password' maxlength='15' required>
          <br>
        <label for='fname'><b>First Name</b></label>
          <input type='text' placeholder='Enter First Name' id='fname' name='fname' maxlength='20' required>

          <label for='lname'><b>Last Name</b></label>
          <input type='text' placeholder='Enter Last Name' id='lname' name='lname' maxlength='25' required>

          <br>

          <button id='signupbtn' class='btn signupbtn' type='submit' formaction='createcustomeraccount.php'>Sign Up</button>
          <br>
       


</form>
</div>";
#-----------------------------------------------------------#
include('footer.php');      
     echo"
  </body>
</html>";

#Close Connection
#mysqli_free_result($result);
mysqli_close($con);
?>