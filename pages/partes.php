
<?php
session_start();
error_reporting(0);

$varsession = $_SESSION['usuario'];
$user_se=$varsession;
if ($varsession == NULL || $varsession = '')
{
	echo '<script>
			alert("Usted no tiene autorizacion ");
		</script>';
		//die();
		header("Location:../index.php");
}
include ("config/conecta.php");

$sql_user= mysqli_query($conec,"SELECT * FROM usuarios WHERE numdoc='$user_se'");
$row_user=mysqli_fetch_array($sql_user);
$tipo_user=$row_user['tipo_user'];
if ($tipo_user==1) {?>

	<!DOCTYPE html>
	<html lang="es">

	<?php include ("url/head.php"); ?>
	<body>
		<?php include ("url/header.php"); ?>
			<section id="container">

					<form name="tecnicos" method="POST" action= "php/partes.php" id="tecnicos">

							<h1 align="center">Registro de Partes </h1><br>
									<label for="tecnicos">Numero de parte:</label>
									<input type="text" name="no_parte" size="50" maxlength="50" required >

									<label for="tecnicos" >Descripcion Parte:</label>
							<input type="textarea" name="descripcion"  placeholder="Descripcion..."></textarea>










							<input type="submit" value="Enviar" />
							<input id="cierre" type="button" onclick=" location.href='ver_partes.php'" value="Ver Partes " name="ver_parte" />
							<?php include ("url/atras.php"); ?>
					</form>







					</form>
			</section>

			</container>


			<footer>

					<h1>Soporte S.A</h1>

			</footer>

		</body>



	</html>

	 <?php

}else {
	echo '<script>
			alert("Usted no tiene autorizacion ");
		</script>';
		header("Location:admin.php");
}
?>
