
<?php
session_start();
error_reporting(0);

$varsession = $_SESSION['usuario'];

if ($varsession == NULL || $varsession = '')
{
	echo '<script>
			alert("Usted no tiene autorizacion ");
		</script>';
		//die();
		header("Location:../index.php");
}
?>

<!DOCTYPE html>
<html lang="es">

<?php include ("url/head.php"); ?>
<body>
	<?php include ("url/header.php"); ?>
		<section id="container">

				<form name="tecnicos" method="POST" action= "php/tecnicos.php" id="tecnicos">

						<h1 align="center">Registro Tecnicos </h1><br>





								<label for="tecnicos">Numero de cedula:</label>
								<input type="text" name="ncedula" size="50" maxlength="50" required >

								<label for="tecnicos">Nombres Tecnico:</label>
								<input type="text" name="ntecnicos"  required >

								<label for="tecnicos">Telefono:</label>
								<input type="text" name="telefono"  required >










						<input type="submit" value="Enviar" />
						<input type="reset" value="Restablecer" />
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
