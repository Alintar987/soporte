<?php
include_once "conexion.php";
 $id_get_user=$_POST['id_get_user'];
 $nombre_user=$_POST["nombre_user"];
 $permiso=$_POST["permiso"];
 $numdoc=$_POST["numdoc"];
 $password=$_POST['password'];




$insertar = "UPDATE usuarios SET nombre_user='$nombre_user', tipo_user='$permiso', numdoc='$numdoc' WHERE id_user='$id_get_user'";







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
			alert("Usuario Actualizado Correctamente.");
			window.location="../users.php";
		</script>';
		exit;
}

//cerrar conexion base de datos

mysqli_close($con);



  ?>
