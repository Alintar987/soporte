
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
  $id_num_caso=$_GET['num_caso'];
  $sql_caso= mysqli_query($conec,"SELECT * FROM ordenes_servicio WHERE id_caso='$id_num_caso'");
  $row=mysqli_fetch_assoc($sql_caso);
  $num_caso=$row['num_caso'];
  $id_caso=$row['id_caso'];
  $estado=$row['estado'];
  $fecha_creacion=$row['fecha_creacion'];
  $fecha_recibido=$row['fecha_recibido'];
  $fecha_onsite=$row['fecha_onsite'];
  $fecha_repair=$row['fecha_repair'];
  $fecha_cierre=$row['fecha_cierre'];

	$nombre_cliente=$row["nombre_clientes"];
	$contacto=$row["contacto"];
	$ciudad=$row["ciudad"];
	$direccion=$row["direccion"];
	$telefono=$row["telefono"];
	$movil=$row["movil"];
	$email=$row['email'];

  $id_serial_equipos=$row['id_serial_equipos'];
  $descripcion_servicio=$row['descripcion_servicio'];
	$sol_servicio=$row['sol_servicio'];
  $tipo_servicio=$row['tipo_servicio'];
	$fecha_contrato=$row['fecha_contrato'];
  $id_tecnico_servicio=$row['id_tecnico_servicio'];
  $id_tecnico_solucion=$row['id_tecnico_solucion'];

  $sql_serial= mysqli_query($conec,"SELECT * FROM equipos WHERE id_equipo='$id_serial_equipos'");
  $row_serial=mysqli_fetch_assoc($sql_serial);
  $serial_equipo=$row_serial['serial_equipo'];
  $sql_tecnico= mysqli_query($conec,"SELECT * FROM tecnicos WHERE id_tecnico='$id_tecnico_servicio'");
  $row_tec=mysqli_fetch_assoc($sql_tecnico);
  $ntecnico=$row_tec['ntecnico'];
  $sql_tecnico_s= mysqli_query($conec,"SELECT * FROM tecnicos WHERE id_tecnico='$id_tecnico_solucion'");
  $row_tec_s=mysqli_fetch_assoc($sql_tecnico_s);
  $ntecnico_s=$row_tec_s['ntecnico'];
  $sql_tecnico_so= mysqli_query($conec,"SELECT * FROM tecnicos WHERE id_tecnico!=$id_tecnico_servicio");
  $sql_tecnico_sol= mysqli_query($conec,"SELECT * FROM tecnicos WHERE id_tecnico!=$id_tecnico_solucion");


   ?>

  <!DOCTYPE html>
  <html lang="es">

  <?php include ("url/head.php"); ?>
  <script src="js/fecha_valida.js" charset="utf-8"></script>
	<script src="../css/jquery.js"></script>
	<link href="../css/dist/css/select2.min.css" rel="stylesheet" />
	<script src="../css/dist/js/select2.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../css/DataTables/css/jquery.dataTables.css">
	<script type="text/javascript" charset="utf8" src="../css/DataTables/js/jquery.dataTables.js"></script>
  <body>
  	<?php include ("url/header.php"); ?>
  		<section id="container">

  				<form name="tecnicos" method="POST" action= "php/edit_orden_servicio.php" id="tecnicos">

  						<h1 align="center"> Edita orden de servicio </h1><br>


  								<label for="tecnicos">Caso:</label>
                  <input type="hidden" name="id_caso" value="<?php echo $id_caso ?>">
  								<input type="text" name="caso" value="<?php echo $num_caso ?>"  readonly>
  								<label for="tecnicos">Estado Actual:</label>
  						 <select  onChange="estadoOnChange(this)" name="estado" required>
  						 	<option value="<?php echo $estado ?>" selected><?php echo $estado ?></option>
  							<option value="Requiere repuesto">Requiere repuesto</option>
  							<option value="Pendiente proveedor">Pendiente proveedor</option>
  							<option value="Repuestos OK">Repuestos OK</option>
  							<option value="Fix time">Fix time</option>
								<option value="Anulado">Anulado</option>
								<option value="Inconcluso">Inconcluso</option>
  							<option value="Caso cerrado">Caso cerrado</option>
  						</select>
  						<label for="tecnicos">Fecha Creación:</label>
  						<input type="" id="fecha_creacion" class="datetime6" name="fecha_creacion" value="<?php echo $fecha_creacion ?>"><input type="checkbox" id="ver_creacion" class="ver" onChange="hideOrShowPassword()"/>Editar Fecha
              <label for="tecnicos">Fecha Recibido:</label>
              <input type="" id="fecha_recibido" class="datetime6" name="fecha_recibido" value="<?php echo $fecha_recibido ?>"><input type="checkbox" id="ver_recibido" class="ver" onChange="hideOrShowPassword1()"/>Editar Fecha
							<?php if ($estado=='Caso cerrado' || $estado=='Fix time' || $estado=='Anulado' ||$estado=='Inconcluso') {?>
								<label for="tecnicos">Fecha Onsite:</label>
							 <input type="" id="fecha_onsite" class="datetime6" name="fecha_onsite" value="<?php echo $fecha_onsite ?>"><input type="checkbox" id="ver_onsite" class="ver" onChange="hideOrShowPassword2()"/>Editar Fecha

							 <label for="tecnicos">Fecha Repair:</label>
							 <input type="" id="fecha_repair" class="datetime6" name="fecha_repair" value="<?php echo $fecha_repair ?>"><input type="checkbox" id="ver_repair" class="ver" onChange="hideOrShowPassword3()"/>Editar Fecha
							 <label for="tecnicos">Fecha Cierre:</label>
							 <input type="" id="fecha_cierre" class="datetime6" name="fecha_cierre" value="<?php echo $fecha_cierre ?>"><input type="checkbox" id="ver_cierre" class="ver" onChange="hideOrShowPassword4()"/>Editar Fecha


								<?php
								# code...
							}else {?>
								<div id="v_fecha" style="display:none;">
											<label for="tecnicos">Fecha Onsite:</label>
			               <input type="" id="fecha_onsite" class="datetime6" name="fecha_onsite" value="<?php echo $fecha_onsite ?>"><input type="checkbox" id="ver_onsite" class="ver" onChange="hideOrShowPassword2()"/>Editar Fecha

			               <label for="tecnicos">Fecha Repair:</label>
			               <input type="" id="fecha_repair" class="datetime6" name="fecha_repair" value="<?php echo $fecha_repair ?>"><input type="checkbox" id="ver_repair" class="ver" onChange="hideOrShowPassword3()"/>Editar Fecha
			               <label for="tecnicos">Fecha Cierre:</label>
			               <input type="" id="fecha_cierre" class="datetime6" name="fecha_cierre" value="<?php echo $fecha_cierre ?>"><input type="checkbox" id="ver_cierre" class="ver" onChange="hideOrShowPassword4()"/>Editar Fecha

								</div>
								<?php
								# code...
							} ?>



                         <?php include ("url/form_clientes_edit.php"); ?>

  						<label for="tecnicos">Serial equipo:</label>
  						 <input type="" class="datetime6" name="" value="<?php echo $serial_equipo ?>" readonly>
							 <input type="checkbox" name="check" id="check" value="1" onchange="javascript:showContent()" />Ver Equipo
							 <div id="content" style="display: none;">
								 <?php 	include ("ver_equipos_caso.php"); ?>
							 </div>

  						<label for="tecnicos" >Descripcion del servicio:</label>
							<textarea name="descripcion_servicio" rows="6" cols="50" ><?php echo $descripcion_servicio ?></textarea>
							<label for="tecnicos" >Solución del servicio:</label>
							<textarea name="sol_servicio" rows="6" cols="50"><?php echo $sol_servicio ?></textarea>

  						<label for="tecnicos">Tipo de servicio:</label>
							<?php
								if ($tipo_servicio=="Contrato") {?>
									<input type="text" name="" value="<?php echo $tipo_servicio ?>" readonly>
									<label for="tecnicos">Fecha Real de Atención:</label>
									<input type="" id="fecha_contrato" class="datetime6" name="fecha_contrato" value="<?php echo $fecha_contrato; ?>"><input type="checkbox" id="ver_contrato" class="ver" onChange="hideOrShowPassword5()"/>Editar Fecha

								<?php
							}else {?><input type="text" name="" value="<?php echo $tipo_servicio ?>" readonly><?php
							}
							 	?>
  						<label for="tecnicos">Técnico Diagnostico:</label>
  						 <select name="tecnico_diagnostico" required>
                 <option value="<?php echo $id_tecnico_servicio ?>"><?php echo $ntecnico ?></option>
                 <?php while ($row=mysqli_fetch_assoc($sql_tecnico_so)) {
                   $id_tecnico=$row['id_tecnico'];
                   $ntecnico=$row['ntecnico'];?>
                   <option value="<?php echo $id_tecnico ?>"><?php echo $ntecnico ?></option>

                 <?php
                 } ?>
  						 </select>

  						 <label for="tecnicos">Tecnico Solucion:</label>
  						 <select name="tecnico_solucion" required>
                 <option value="<?php echo $id_tecnico_solucion ?>"><?php echo $ntecnico_s ?></option>
                 <?php while ($row=mysqli_fetch_assoc($sql_tecnico_sol)) {
                   $id_tecnico=$row['id_tecnico'];
                   $ntecnico=$row['ntecnico'];?>
                   <option value="<?php echo $id_tecnico ?>"><?php echo $ntecnico ?></option>
                 <?php
                 } ?>
  						 </select>
               <input type="submit" value="Actualizar" />
               <button type="button" id="cierre" name="button"><a href="ver_part_caso.php?caso_id=<?php echo $id_caso ?>&caso_n=<?php echo $num_caso ?>">Ver Partes</a></button>

  						<?php include ("url/atras.php"); ?>
  				</form>

  		</section>
  		</container>
  		<footer>
  				<h1>Soporte S.A</h1>

  		</footer>
			<script type="text/javascript">
	    $(document).ready(function() {
	    $('#ciudad').select2();
					});

	    </script>


					<script type="text/javascript">
					function estadoOnChange(sel) {
					if (sel.value=="Fix time"){
							 divC = document.getElementById("v_fecha");
							 divC.style.display = "";

					}else if (sel.value=="Caso cerrado") {
						divC = document.getElementById("v_fecha");
						divC.style.display = "";
					}else if (sel.value=="Anulado") {
						divC = document.getElementById("v_fecha");
						divC.style.display = "";
					}else if (sel.value=="Inconcluso") {
						divC = document.getElementById("v_fecha");
						divC.style.display = "";
					}else if (sel.value!=="Fix time" || sel.value!=="Caso cerrado" || sel.value!=="Anulado" || sel.value!=="Inconcluso") {
						divC = document.getElementById("v_fecha");
						divC.style.display = "none";
					}
			}
			    </script>
					<script type="text/javascript">
			    $(document).ready(function() {
			    $('#ver_orden').DataTable({
						"paging":   false,
						"ordering": false,
							"info":     false,
							"searching": false

					});
			} );

			    </script>

					<script type="text/javascript">
    function showContent() {
        element = document.getElementById("content");
        check = document.getElementById("check");
        if (check.checked) {
            element.style.display='block';
        }
        else {
            element.style.display='none';
        }
    }
		</script>
		<script type="text/javascript">
		function hideOrShowPassword5() {
			var password1, check;

			password1 = document.getElementById("fecha_contrato");
			check = document.getElementById("ver_contrato");

			if (check.checked == false) // Si la checkbox de mostrar contraseña está activada
			{
				password1.type = "";
			} else // Si no está activada
			{
				password1.type = "datetime-local";
			}
		}
		</script>
    	</body>
      </html>
