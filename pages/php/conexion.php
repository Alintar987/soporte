<?php 



$con = new mysqli("localhost","root","","ordenes");

if ($con->connect_errno) 
{
	echo "Fallo al conectar:(".$mysqli->connect_errno .")".$mysqli->connect_errno;
}


 ?>
