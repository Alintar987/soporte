
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

<?php
include ("config/conecta.php");
$sql_parte= mysqli_query($conec,"SELECT * FROM partes");
$sql_repuestos= mysqli_query($conec,"SELECT * FROM repuestos GROUP BY  part_order");


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

				<form name="tecnicos" method="POST" action= "" id="tecnicos">

						<h1 align="center">Partes Recibidas</h1><br>
						<label for="tecnicos">Part order:</label>
						<select class="parte" name="part_order" required>
							<option value="">Seleccione PO</option>
							<?php while ($row=mysqli_fetch_assoc($sql_repuestos)) {
							$id_repuestos=$row['id_repuestos'];
							$part_order=$row['part_order'];?>
							<option value="<?php echo $part_order ?>"><?php echo $part_order ?></option>

							<?php
							} ?>
						</select>
						<input type="submit" name="busca" value="Buscar">

						<?php if (isset($_POST['busca'])) {

							$id_num_parte =$_POST['part_order'];
							include ("php/getservice.php");
							# code...
						} ?>


						<?php include ("url/atras.php"); ?>
				</form>
		</section>

		</container>


		<footer>

				<h1>Soporte S.A</h1>

		</footer>


		<script>

		$(document).ready(function() {
	$('.partes').select2();
			});
		</script>
		<script>

		$(document).ready(function() {
	$('.parte').select2();
			});
		</script>


	</body>



</html>
