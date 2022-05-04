<?php
session_start();
#logout
session_destroy();
echo "<br> Logout Successful";
header("Location: https://localhost/BookWorm/index.php");
exit();

?>