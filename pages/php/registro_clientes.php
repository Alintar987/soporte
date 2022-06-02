<?php
include_once "conexion.php";

$nombre_cliente=$_POST["nombre_cliente"];
$contacto=$_POST["contacto"];
$ciudad=$_POST["ciudad"];
$direccion=$_POST["direccion"];
$telefono=$_POST["telefono"];
$movil=$_POST["movil"];
$email=$_POST["email"];


$insertar = "INSERT INTO clientes VALUES ('','$nombre_cliente','$contacto','$ciudad','$direccion','$telefono','$movil','$email')";



$validacion = mysqli_query($con, "SELECT * FROM clientes WHERE nombre_clientes='$nombre_cliente'");

if (mysqli_num_rows($validacion)>0) {
	echo '<script>
			alert("Este cliente ya esta registrado.");
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
			alert("Cliente registrado Correctamente.");
			window.location="../admin.php";
		</script>';
		exit;
}

//cerrar conexion base de datos

mysqli_close($con);



  ?>
