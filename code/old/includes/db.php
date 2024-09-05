<?php

$servername = "localhost";
$username = "trevahoj_user1";
$pass = "Vx(U}1Q5cKH0";
$dbname = "trevahoj_dbone";

$conn = mysqli_connect($servername,$username,$pass,$dbname);

if(!$conn)
{
	echo "something went wrong with database connection";     
}