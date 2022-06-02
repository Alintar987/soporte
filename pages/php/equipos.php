<?php
include_once "conexion.php";

$nombre_equipo=$_POST["nombre_equipo"];
$descripcion=$_POST["descripcion"];
$product_number=$_POST["product_number"];
$serial_equipo=$_POST["serial_equipo"];



$insertar = "INSERT INTO equipos VALUES ('','$serial_equipo','$nombre_equipo','$descripcion','$product_number')";



$validacion = mysqli_query($con, "SELECT * FROM equipos WHERE serial_equipo='$serial_equipo'");

if (mysqli_num_rows($validacion)>0) {
	echo '<script>
			alert("Este equipo ya esta registrado.");
			window.history.go(-1);
		</script>';
		exit;
}




// ejecutar consulta
$resultado = mysqli_query($con,$insertar);

if (!$resultado) {
	echo'<script>
			alert("Error al registrar. Si el problema continua, intente mas tarde");
			window.history.go(-1);
		</script>';
		exit;
}else {
	echo '<script>
			alert("Equipo registrado Correctamente.");
			window.location="../admin.php";
		</script>';
		exit;
}

//cerrar conexion base de datos

mysqli_close($con);



  ?>
