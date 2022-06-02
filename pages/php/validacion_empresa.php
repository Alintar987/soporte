<?php
//validacion de inicio de sesion 
	
	 include_once "conexion.php";

$cliente=$_POST['ncliente'];

session_start();
	$_SESSION['nit']=$cliente;

$validar = "SELECT * FROM clientes WHERE id_cliente='$cliente'";

$resultado= $con->query($validar);

if ($resultado->num_rows>0) {	
	header("Location: ../registro_casos1.php");}
else
{
	echo '<script>
			alert("El NIT ingresado no corresponde a ningna empresa  o usuario registrado");
			window.history.go(-1);
		</script>';
		exit;

}

?>