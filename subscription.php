<?php
#Start the session
session_start();
#<!DOCTYPE html>
include "dbconfig.php";
#dbconfig.php allows the neccessary information to login to the db without hardcoding it into each php file.
#include "dbconfig.php";
$con = mysqli_connect($host,$username, $password, $dbname);
$_SESSION['currentPage'] = "https://localhost/BookWorm/subscription.php";

#Check for login errors
if(isset($_SESSION["loginError"]) AND $_SESSION["loginError"] == True  ){
    $_SESSION["loginError"] = False;
    echo'<script>alert("Incorrect Login. Please check your email and password.")</script>';

            }

echo"<html lang='en'>\n";
include "header.php";
echo" <!-- ----------Subscription plan details------------- -->";


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
    </div> -->";
    include("footer.php");
   
  
  echo"</body>
</html> ";

#Close Connection
mysqli_free_result($result);
mysqli_close($con);

?>