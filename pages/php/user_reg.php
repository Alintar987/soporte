<?php
include_once "conexion.php";
 $nombre_user=$_POST["nombre_user"];
 $permiso=$_POST["permiso"];
 $numdoc=$_POST["numdoc"];
 $password=$_POST['password'];




$insertar = "INSERT INTO usuarios VALUES('','$nombre_user','$permiso','$numdoc','$password')";







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
			alert("Usuario Registrado Correctamente.");
			window.location="../users.php";
		</script>';
		exit;
}

//cerrar conexion base de datos

mysqli_close($con);



  ?>
