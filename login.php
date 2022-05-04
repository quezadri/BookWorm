<?php
session_start();
#Login 

include('dbconfig.php');
$con = mysqli_connect($host,$username, $password, $dbname);

$email= mysqli_real_escape_string($con, $_POST['email']);
$password=mysqli_real_escape_string($con, $_POST['password']);
$page =  $_SESSION['currentPage'];

$sql = "SELECT cid, email, password FROM bookwormdb.customers WHERE email='$email' ";
$result = mysqli_query($con, $sql);

if($result){
	if(mysqli_num_rows($result)>0){
		while($row = mysqli_fetch_array($result)){
			$cemail = $row["email"];
			$cpassword = $row['password'];
			$cid =$row['cid'];
			#Checks if entered password exists within the query. If so tell the user login is successful and set a cookie
			if ($password == $cpassword){  
				#echo "<br>Login Successful";
				#setcookie("user", $cid, time()+60*60);
				$_SESSION["loginError"] = False;
				$_SESSION['customerLoggedIn'] = True;
				$_SESSION['customerID'] = $cid;
				echo "<br> Login Successful";
				header("Location: $page");
				#Close Connection
				mysqli_free_result($result);
				mysqli_close($con);
				exit();

}
else {echo "<br> Login Failed";
				$_SESSION['loginError'] = True;
				header("Location: $page");
				#Close Connection
				mysqli_free_result($result);
				mysqli_close($con);
				exit();
			}
}}}

#Close Connection
mysqli_free_result($result);
mysqli_close($con);

?>