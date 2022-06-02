
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
?>

<!DOCTYPE html>
<html lang="es">
<?php include ("url/link.php"); ?>
<body>

	<header>
			<img src="../imagenes/soporte.png" style="height:160px;" id="logo">


	</header>
		<section id="container">

<?php include ("url/menu.php"); ?>
		<br>

	<embed src="pag/index.php" height="750" width="1000" style="border:none;">
		</section>

		</container>


		<footer>

				<h1>Soporte S.A</h1>


		</footer>

	</body>

</html>
