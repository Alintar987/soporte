
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
$sql_repuestos= mysqli_query($conec,"SELECT * FROM repuestos GROUP BY  part_order");
$sql_servicio= mysqli_query($conec,"SELECT * FROM ordenes_servicio");
$sql_partes= mysqli_query($conec,"SELECT * FROM partes");

 ?>

<!DOCTYPE html>
<html lang="es">

<?php include ("url/head.php"); ?>
<script src="../css/jquery.js"></script>
<link href="../css/dist/css/select2.min.css" rel="stylesheet" />
<script src="../css/dist/js/select2.min.js"></script>
<?php include ("url/busca_parte2.php"); ?>
<body>
	<?php include ("url/header.php"); ?>
		<section id="container">

				<form name="tecnicos" method="POST" action= "php/visitas.php" id="tecnicos">

						<h1 align="center">Cargue Partes </h1><br>
								<label for="caso">Caso:</label>

								<select id="caso" name="caso">
									<option value=""></option>
									<?php while ($row=mysqli_fetch_assoc($sql_servicio)) {
									$id_caso=$row['id_caso'];
									$num_caso=$row['num_caso'];?>
									<option value="<?php echo $id_caso ?>"><?php echo $num_caso ?></option>

									<?php
									} ?>
								</select>
								<label for="tecnicos">Work order:</label>
								<input type="text" name="work_order">

							<label for="tecnicos"> Part order:</label>
							<input type="text" name="part_order" value="">
							<label for="tecnicos"> Numero de parte:</label>
							<select class="partes" name="partes[]" multiple="multiple" onchange="showService(this.value)" required>
											<?php while ($row=mysqli_fetch_assoc($sql_partes)) {
											$id_partes=$row['id_partes'];
											$no_parte=$row['no_parte'];?>
											<option value="<?php echo $id_partes ?>"><?php echo $no_parte ?></option>

											<?php
											} ?>
								</select>
								<label for="tecnicos">Descripción Parte:</label>
								<textarea id="txtHint" name="name" rows="8" cols="40"></textarea>
								<label for="tecnicos">Fecha:</label>
						<input type="datetime-local" id="datetime5" name="fecha" required>



						<br>




						<input type="submit" value="Enviar" />
						<?php include ("url/atras.php"); ?>
				</form>
				</form>
				<div id="insert">

					</div>
		</section>

		</container>


		<footer>

				<h1>Soporte S.A</h1>

		</footer>

<script type="text/javascript">
		$(document).ready(function() {
	$('#caso').select2();
		});
		</script>

		<script type="text/javascript">
				$(document).ready(function() {
			$('.partes').select2();
				});
				</script>

	</body>



</html>
