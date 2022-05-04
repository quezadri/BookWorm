<?php
session_start();
#create customer account

include('dbconfig.php');
$con = mysqli_connect($host,$username, $password, $dbname);

$email= mysqli_real_escape_string($con, $_POST['email']);
$password=mysqli_real_escape_string($con, $_POST['password']);
$fname=mysqli_real_escape_string($con, $_POST['fname']);
$lname=mysqli_real_escape_string($con, $_POST['lname']);
$page =  $_SESSION['currentPage'];

#We want to grab the previous/highest cid, and increment it to the next one
$sqlchk= "SELECT cid FROM bookwormdb.customers ORDER BY cid DESC LIMIT 1";
$resultchk = mysqli_query($con, $sqlchk);
#turn the results into a usable variable
$rowchk = mysqli_fetch_row($resultchk);
	$pcid = $rowchk[0];  #previous cid

print_r(preg_split('/[^A-Za-z0-9\s]/i', $pcid));
list($c, $num) = preg_split('/(\d+)/', $pcid, -1, PREG_SPLIT_DELIM_CAPTURE);
echo"<br>";
$num = $num + 1;
#This is the new current cid to be used with the query
$cid = $c. sprintf('%04d',$num);

$sql = "INSERT INTO bookwormdb.customers(cid, email, password, fname, lname) VALUES ('$cid', '$email', '$password', '$fname', '$lname')";
#$result = mysqli_query($con, $sql);
if (!mysqli_query($con, $sql)){
  echo("Error description: " . mysqli_error($con));
  $_SESSION['signupError'] = True;
  header("Location: $page");
  #Close Connection
  mysqli_free_result($result);
  mysqli_close($con);
  exit();
}
else{
				$_SESSION["loginError"] = False;
				$_SESSION['signupError'] = False;
				$_SESSION['customerLoggedIn'] = True;
				$_SESSION['customerID'] = $cid;
				echo "<br> Login Successful";
				header("Location: https://localhost/BookWorm/index.php");
				#Close Connection
				mysqli_free_result($result);
				mysqli_close($con);
				exit();
}


#Close Connection
mysqli_free_result($resultchk);
mysqli_close($con);

?>