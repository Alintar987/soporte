
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
$sql_cliente= mysqli_query($conec,"SELECT * FROM clientes");
$sql_equipos= mysqli_query($conec,"SELECT * FROM equipos");
$sql_tecnicos= mysqli_query($conec,"SELECT * FROM tecnicos");
$sql_tecnicos_s= mysqli_query($conec,"SELECT * FROM tecnicos");
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

				<form name="tecnicos" method="POST" action= "php/orden_servicio.php" id="tecnicos">

						<h1 align="center"> Registro orden de servicio </h1><br>


								<label for="tecnicos">Caso:</label>
								<input type="text" name="caso" size="50" maxlength="50" required >
								<label for="tecnicos">Estado:</label>
						 <select name="estado" required>
						 	<option value=""></option>
							<option value="Requiere repuesto">Requiere repuesto</option>
							<option value="Pendiente proveedor">Pendiente proveedor</option>
							<option value="Repuestos OK">Repuestos OK</option>
							<option value="Fix time">Fix time</option>
							<option value="Anulado">Anulado</option>
							<option value="Inconcluso">Inconcluso</option>
							<option value="Caso cerrado">Caso cerrado</option>
						</select>
						<label for="tecnicos">Fecha Creación:</label>
						<input type="datetime-local" id="datetime1" name="fecha_creacion" required>
            <label for="tecnicos">Fecha Recibido:</label>
						<input type="datetime-local" id="datetime1" name="fecha_recibido" required>
                        <label for="tecnicos">Fecha Onsite:</label>
						<input type="datetime-local" id="datetime1" name="fecha_onsite">
                        <label for="tecnicos">Fecha Repair:</label>
						<input type="datetime-local" id="datetime1" name="fecha_repair">
                        <label for="tecnicos">Fecha Cierre:</label>
						<input type="datetime-local" id="datetime1" name="fecha_cierre">
						 <?php include ("url/form_clientes.php"); ?>

						<label for="tecnicos">Serial equipo:</label>
						 <select class="seriales" name="serial_equipos" required>
							 <option value=""></option>
               <?php while ($row=mysqli_fetch_assoc($sql_equipos)) {
               $id_equipo=$row['id_equipo'];
               $serial_equipo=$row['serial_equipo'];?>
               <option value="<?php echo $id_equipo ?>"><?php echo $serial_equipo ?></option>

               <?php
               } ?>
             </select>

						<label for="tecnicos" >Descripcion del servicio:</label>
						<textarea name="descripcion_servicio" rows="6" cols="50" placeholder="Descripcion..."></textarea>
						<label for="tecnicos" >Solución del servicio:</label>
						<textarea name="sol_servicio" rows="6" cols="50" placeholder="Solución..."></textarea>

						<label for="tecnicos">Tipo de servicio:</label>
						 <select name="pago" onChange="pagoOnChange(this)" required>
						 	<option value=""></option>
						 	<option value="Onsite">Onsite</option>
						 	<option value="Bench">Bench</option>
						 	<option value="Contrato">Contrato</option>
						 	<option value="Instalacion">Instalación</option>
							<option value="Proactivo">Proactivo</option>
						</select>
						<div id="v_contrato" style="display:none;">
								<label for="tecnicos">Fecha Real de Atención:</label>
								<input type="datetime-local" id="datetime1" name="fecha_real">
						</div>

						<label for="tecnicos">Tecnico Diagnostico:</label>
						 <select name="tecnico_diagnostico" required>
							 <option value="Por Registrar">Por Registrar</option>
               <?php while ($row=mysqli_fetch_assoc($sql_tecnicos)) {
                 $id_tecnico=$row['id_tecnico'];
                 $ntecnico=$row['ntecnico'];?>
                 <option value="<?php echo $id_tecnico ?>"><?php echo $ntecnico ?></option>

               <?php
               } ?>
						 </select>

						 <label for="tecnicos">Tecnico Solucion:</label>
						 <select name="tecnico_solucion" required>
							 <option value="Por Registrar">Por Registrar</option>
               <?php while ($row=mysqli_fetch_assoc($sql_tecnicos_s)) {
                 $id_tecnico=$row['id_tecnico'];
                 $ntecnico=$row['ntecnico'];?>
                 <option value="<?php echo $id_tecnico ?>"><?php echo $ntecnico ?></option>

               <?php
               } ?>
						 </select><br>
             <input type="submit" value="Enviar" />

						<?php include ("url/atras.php"); ?>
				</form>

		</section>
		</container>
		<footer>
				<h1>Soporte S.A</h1>

		</footer>
    <script type="text/javascript">
    $(document).ready(function() {
    $('.seriales').select2();
			});
    </script>
		<script type="text/javascript">
    $(document).ready(function() {
    $('#ciudad').select2();
			});
    </script>


		<script type="text/javascript">
		function pagoOnChange(sel) {
		if (sel.value=="Contrato"){
				 divC = document.getElementById("v_contrato");
				 divC.style.display = "";

		}else if (sel.value!=="Contrato") {
			divC = document.getElementById("v_contrato");
			divC.style.display = "none";
		}
}
    </script>

  	</body>
    </html>
