<?php
include_once "conexion.php";

$ncedula=$_POST["ncedula"];
$ntecnicos=$_POST["ntecnicos"];
$telefono=$_POST["telefono"];




$insertar = "INSERT INTO tecnicos VALUES ('','$ntecnicos','$ncedula','$telefono')";



$validacion = mysqli_query($con, "SELECT * FROM tecnicos WHERE ncedula='$ncedula'");

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
			alert("Tecnico registrado correctamente.");
			window.location="../admin.php";
		</script>';
		exit;
}

//cerrar conexion base de datos

mysqli_close($con);



  ?>
