
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
  $parte_id=$_GET['parte_id'];
  $sql_parte= mysqli_query($conec,"SELECT * FROM partes WHERE id_partes='$parte_id'");
  $row=mysqli_fetch_assoc($sql_parte);
  $id_partes=$row['id_partes'];
  $no_parte=$row['no_parte'];
  $descripcion=$row['descripcion'];


   ?>

  <!DOCTYPE html>
  <html lang="es">

  <?php include ("url/head.php"); ?>
  <script src="js/fecha_valida.js" charset="utf-8"></script>
	<script src="../css/jquery.js"></script>
	<link href="../css/dist/css/select2.min.css" rel="stylesheet" />
	<script src="../css/dist/js/select2.min.js"></script>
  <body>
  	<?php include ("url/header.php"); ?>
  		<section id="container">

  				<form name="tecnicos" method="POST" action= "php/edit_parte.php" id="tecnicos">

  						<h1 align="center"> Edita Parte </h1><br>


  								<label for="tecnicos">Numero de Parte:</label>
                  <input type="hidden" name="id_partes" value="<?php echo $id_partes ?>">
  								<input type="text" name="caso" value="<?php echo $no_parte ?>"  readonly>
  								<label for="tecnicos">Descripción:</label>
									<textarea name="descripcon" rows="8" cols="40" readonly><?php echo $descripcion ?></textarea>
									<label for="tecnicos">Numero de Parte:</label>
									<select class="" name="estado">
										<option value="No ha Llegado">No ha Llegado</option>
										<option value="Disponible">Disponible</option>
									</select>
									
									<label for="tecnicos">Fecha Llegada:</label>
                  <input type="datetime-local" id="datetime1" name="fecha_llegada"><br>
               <input type="submit" value="Actualizar" />

  						<input id="cierre" type="button" onclick=" location.href='repuestos.php'" value="Regresar " name="regresar" />
  				</form>

  		</section>
  		</container>
  		<footer>
  				<h1>Soporte S.A</h1>

  		</footer>
    	</body>
      </html>
