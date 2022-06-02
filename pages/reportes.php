
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
$sql_user_get= mysqli_query($conec,"SELECT * FROM usuarios WHERE id_user='$get_user'");
$row_user_get=mysqli_fetch_array($sql_user_get);
$id_get=$row_user_get['id_user'];
$user_get=$row_user_get['tipo_user'];
$nombre_get=$row_user_get['nombre_user'];
$pass_get=$row_user_get['password'];
$doc_get=$row_user_get['numdoc'];
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

					<form name="tecnicos" method="POST" action= "excel/exportar.php" id="tecnicos">

							<h1 align="center">Reportes</h1><br>
									<label for="reporte">Tipo Reporte:</label>
									<select class="" name="t_reporte">
										<option value="cobro">Cobros</option>
										<option value="bono">Bonos</option>
										<option value="recibidos">Recibidos</option>
										<option value="solucionados">Solucionados</option>
									</select>
                  <label for="f_inicio">Fecha Inicio:</label>
									<input type="date" name="f_inicio" id="datetime1" value="" required>
									<label for="f_fin">Fecha Fin:</label>
									<input type="date" name="f_fin" id="datetime1" value="" required>
									<br>
							<input type="submit" value="Enviar" />
							<?php include ("url/atras.php"); ?>
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
