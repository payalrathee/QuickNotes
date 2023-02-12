<?php

//database connectivity variables
$servername="localhost";
$db_user="root";
$db_password="";
$db_name="quick_notes";

//establish connection
$conn=mysqli_connect($servername,$db_user,$db_password,$db_name);

//check connection
if(!$conn)
die("We are facing some issues. Please try again later.<br>Sorry for the inconvenience caused!");

?>