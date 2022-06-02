
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
$sql_equipos= mysqli_query($conec,"SELECT * FROM equipos");

$sql_user= mysqli_query($conec,"SELECT * FROM usuarios WHERE numdoc='$user_se'");
$row_user=mysqli_fetch_array($sql_user);
$tipo_user=$row_user['tipo_user'];
?>
<!DOCTYPE html>
<html lang="es">
<?php include ("url/head.php"); ?>
<script src="../css/jquery.js"></script>
<link href="../css/dist/css/select2.min.css" rel="stylesheet" />
<script src="../css/dist/js/select2.min.js"></script>
<body>
	<?php include ("url/header.php"); ?>
		<section id="container">

				<form name="tecnicos" method="POST" action= "php/equipos.php" id="tecnicos">

						<h1 align="center">Registro Equipos </h1><br>
								<label for="tecnicos">Nombre equipo:</label>
								<?php
								if ($tipo_user==1) {

									?>
									<input type="text" name="nombre_equipo" size="50"  required >
									<?php
								}else {
									?>
									<select class="nombre_equipo" name="nombre_equipo">
										<?php
										while ($row_equipos=mysqli_fetch_array($sql_equipos)) {
											$nombre_equipo=$row_equipos['nombre_equipo'];
										 ?>
										 <option value="<?php echo $nombre_equipo ?>"><?php echo $nombre_equipo ?></option>
									<?php
								} echo "</select>";}
								 ?>

								<label for="tecnicos">Descripcion:</label>
						 <select name="descripcion" required>
						 	<option value=""></option>
							<option value="Portatil">Portatil</option>
							<option value="Desktop">Desktop</option>
							<option value="Servidor">Servidor</option>
							<option value="Monitor">Monitor</option>
							<option value="Impresora">Impresora</option>
						</select>

								<label for="tecnicos"> Product Number:</label>
								<input type="text" name="product_number" size="50" maxlength="50" required >
								<label for="tecnicos"> Serial equipo:</label>
							<input type="text" name="serial_equipo" size="20" maxlength="20" required >





							<br>
						<input type="submit" value="Enviar" />
						<input id="cierre" type="button" onclick=" location.href='ver_equipos.php'" value="Ver Equipos"  />
						<?php include ("url/atras.php"); ?>
				</form>







				</form>
		</section>

		</container>


		<footer>

				<h1>Soporte S.A</h1>

		</footer>
		<script type="text/javascript">
    $(document).ready(function() {
    $('.nombre_equipo').select2();
			});
    </script>
	</body>



</html>
