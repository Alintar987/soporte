<?php
include_once "conexion.php";

$no_parte=$_POST["no_parte"];
$descripcion=$_POST["descripcion"];




$insertar = "INSERT INTO partes VALUES ('','$no_parte','$descripcion')";



$validacion = mysqli_query($con, "SELECT * FROM partes WHERE no_parte='$no_parte'");

if (mysqli_num_rows($validacion)>0) {
	echo '<script>
			alert("Esta parte ya esta registrada.");
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
			alert("Parte registrada Correctamente.");
			window.location="../admin.php";
		</script>';
		exit;
}

//cerrar conexion base de datos

mysqli_close($con);



  ?>
