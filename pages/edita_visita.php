
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
?>  <?php
  include ("config/conecta.php");
  $work_order=$_GET['order'];
  $sql_visita= mysqli_query($conec,"SELECT * FROM visitas WHERE work_order='$work_order'");
  $row=mysqli_fetch_assoc($sql_visita);
  $num_caso=$row['num_caso'];
  $id_caso=$row['id_caso'];
  $estado=$row['estado'];
  $fecha_creacion=$row['fecha_creacion'];
  $fecha_recibido=$row['fecha_recibido'];
  $fecha_onsite=$row['fecha_onsite'];
  $fecha_repair=$row['fecha_repair'];
  $fecha_cierre=$row['fecha_cierre'];
  $id_clientes_servicio=$row['id_clientes_servicio'];
  $id_serial_equipos=$row['id_serial_equipos'];
  $descripcion_servicio=$row['descripcion_servicio'];
  $tipo_servicio=$row['tipo_servicio'];
  $id_tecnico_servicio=$row['id_tecnico_servicio'];
  $id_tecnico_solucion=$row['id_tecnico_solucion'];

  $sql_cliente= mysqli_query($conec,"SELECT * FROM clientes WHERE id_cliente='$id_clientes_servicio'");
  $row_cli=mysqli_fetch_assoc($sql_cliente);
  $nombre_clientes=$row_cli['nombre_clientes'];
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
  <body>
  	<?php include ("url/header.php"); ?>
  		<section id="container">

  				<form name="tecnicos" method="POST" action= "php/edit_orden_servicio.php" id="tecnicos">

  						<h1 align="center">Editar Visita </h1><br>


  								<label for="order">Work Order:</label>
  								<input type="text" name="caso" value="<?php echo $num_caso ?>"  readonly>
  								<label for="caso">Caso:</label>
  						    <input type="text" name="caso" value="<?php echo $num_caso ?>"  readonly>
  						<label for="tecnicos">Part Order:</label>
  						<input type="" id="fecha_creacion" class="datetime6" name="fecha_creacion" value="<?php echo $fecha_creacion ?>"><input type="checkbox" id="ver_creacion" class="ver" onChange="hideOrShowPassword()"/>Editar Fecha
              <label for="tecnicos">Fecha Recibido:</label>
              <input type="" id="fecha_recibido" class="datetime6" name="fecha_recibido" value="<?php echo $fecha_recibido ?>"><input type="checkbox" id="ver_recibido" class="ver" onChange="hideOrShowPassword1()"/>Editar Fecha
  						            <label for="tecnicos">Fecha Onsite:</label>
              <input type="" id="fecha_onsite" class="datetime6" name="fecha_onsite" value="<?php echo $fecha_onsite ?>"><input type="checkbox" id="ver_onsite" class="ver" onChange="hideOrShowPassword2()"/>Editar Fecha

                          <label for="tecnicos">Fecha Repair:</label>
              <input type="" id="fecha_repair" class="datetime6" name="fecha_repair" value="<?php echo $fecha_repair ?>"><input type="checkbox" id="ver_repair" class="ver" onChange="hideOrShowPassword3()"/>Editar Fecha

                          <label for="tecnicos">Fecha Cierre:</label>
              <input type="" id="fecha_cierre" class="datetime6" name="fecha_cierre" value="<?php echo $fecha_cierre ?>"><input type="checkbox" id="ver_cierre" class="ver" onChange="hideOrShowPassword4()"/>Editar Fecha

                          <label for="tecnicos">Nombre del cliente:</label>
  						 <input type="text" name="" value="<?php echo $nombre_clientes ?>" readonly>

  						<label for="tecnicos">Serial equipo:</label>
  						 <input type="text" name="" value="<?php echo $serial_equipo ?>" readonly>

  						<label for="tecnicos" >Descripcion del servicio:</label>
  						<input type="textarea" name="descripcion_servicio" value="<?php echo $descripcion_servicio ?>"></textarea>

  						<label for="tecnicos">Tipo de servicio:</label>
  						 <input type="text" name="" value="<?php echo $tipo_servicio ?>" readonly>
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
               <input id="cierre" type="button" onclick=" location.href='admin.php'" value="Ver Ordenes" name="Ver Ordenes" />

  						<?php include ("url/atras.php"); ?>
  				</form>

  		</section>
  		</container>
  		<footer>
  				<h1>Soporte S.A</h1>

  		</footer>
    	</body>
      </html>
