<?php
$conec = mysqli_connect("localhost","root","","ordenes");;
if (!$conec) {
    die('No pudo conectarse: ' . mysqli_error());
}
//echo 'Conectado satisfactoriamente';
//mysqli_close($conec);

?>
