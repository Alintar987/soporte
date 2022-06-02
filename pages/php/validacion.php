<?php
//validacion de inicio de sesion

	 include_once "conexion.php";

$numdoc=$_POST['numdoc'];
$password=$_POST['password'];

session_start();
		$_SESSION['usuario']=$numdoc;

$validar = "SELECT * FROM usuarios WHERE numdoc='$numdoc' AND password='$password'";

$resultado= $con->query($validar);

if ($resultado->num_rows>0) {
	header("Location: ../admin.php");}
else
{
	echo '<script>
			alert("Error al inicio de sesion, intente nuevamente");
			window.history.go(-1);
		</script>';
		exit;


}

?>
