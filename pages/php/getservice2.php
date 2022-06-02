<?php
include ("../config/conecta.php");

$id_num_parte =$_GET['service'];

$sql_parte= mysqli_query($conec,"SELECT * FROM partes WHERE id_partes='$id_num_parte'");
$row=mysqli_fetch_assoc($sql_parte);

$descripcion=$row['descripcion'];
echo $descripcion;


 ?>
