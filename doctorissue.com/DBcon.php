<?php

	$host='localhost:3306';
    $user = 'doctorissue_minhazuddin';
	$pass = 'minhaz!@#$%';
	$db = 'doctorissue_hbook';//just place it with your database name
	//$con = new mysqli($host, $user, $pass, $db) or die("Unable to connect");
	$con=mysqli_connect($host, $user, $pass, $db) or die("Unable to connect");


?>
