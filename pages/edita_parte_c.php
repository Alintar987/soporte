
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
	$po=$_GET['po'];
  $parte_id=$_GET['parte_id'];
	$num_ca=$_GET['num_ca'];
	$id_caso=$_GET['id_caso'];
	$id_repuestos=$_GET['id_repuestos'];
  $sql_parte= mysqli_query($conec,"SELECT * FROM partes WHERE no_parte='$parte_id'");
  $row=mysqli_fetch_assoc($sql_parte);
  $id_partes=$row['id_partes'];
  $no_parte=$row['no_parte'];
  $descripcion=$row['descripcion'];

	$sql_repu= mysqli_query($conec,"SELECT * FROM repuestos WHERE id_repuestos='$id_repuestos' AND no_parte='$id_partes' AND part_order='$po'");
  $row_r=mysqli_fetch_assoc($sql_repu);
	$serial_parte=$row_r['serial_parte'];
	$id_repuestos_v=$row_r['id_repuestos'];
	$serial_def=$row_r['serial_def'];
	$serial_guia=$row_r['serial_guia'];
	$uso_parte=$row_r['uso_parte'];
	$part_reem=$row_r['part_reem'];
	$fecha_parte=$row_r['fecha_parte'];
	$estado_parte=$row_r['estado_parte'];



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

  				<form name="tecnicos" method="POST" action= "php/edit_parte_c.php" id="tecnicos">

  						<h1 align="center"> Edita Parte </h1><br>


  								<label for="tecnicos">Numero de Parte:</label>
									<input type="hidden" name="id_repuestos" value="<?php echo $id_repuestos_v ?>">
									<input type="hidden" name="po" value="<?php echo $po ?>">
                  <input type="hidden" name="id_partes" value="<?php echo $id_partes ?>">
									<input type="hidden" name="id_caso_c" value="<?php echo $id_caso ?>">
									<input type="hidden" name="num_ca_c" value="<?php echo $num_ca ?>">

  								<input type="text" name="caso" value="<?php echo $no_parte ?>"  readonly>
  								<label for="tecnicos">Descripción:</label>
									<textarea name="descripcon" rows="8" cols="40" readonly><?php echo $descripcion ?></textarea>
									<label for="tecnicos">Estado:</label>
									<select class="" name="estado" required>
										<?php if ($estado_parte=="Disponible") {?>
											<option  value="Disponible">Disponible</option>
											<option value="">No ha Llegado</option>

											<?php
											# code...
										} ?>
										<?php if ($estado_parte=="") {?>
											<option value="" selected>No ha Llegado</option>
											<option value="Disponible">Disponible</option>

											<?php
											# code...
										} ?>

									</select>
									<label for="tecnicos">Reemplazar:</label>
									<input type="checkbox" id="reem">
									<input type="text" id="reem_t" name="reem" value="<?php echo $part_reem; ?>" disabled>
									<label for="tecnicos">Serial Nuevo:</label>

									<input type="text" name="serial_parte" value="<?php echo $serial_parte ?>" required>
									<label for="tecnicos">Uso parte:</label>
									<select name="uso_parte">
									  <?php if ($uso_parte=='') {?>
									    <option value=""></option>
									    <option value="Nuevo">Nuevo sin usar</option>
									    <option value="Usado">Usado</option>
									    <option value="DOA">DOA</option>
									    <?php
									  } ?>


									              <?php if ($uso_parte=='Nuevo') {?>
									                <option value="Nuevo">Nuevo sin usar</option>
									                <option value="Usado">Usado</option>
									                <option value="DOA">DOA</option>
									                <?php
									              } ?>

									                          <?php if ($uso_parte=='Usado') {?>
									                            <option value="Usado">Usado</option>
									                            <option value="Nuevo">Nuevo sin usar</option>
									                            <option value="DOA">DOA</option>
									                            <?php
									                          } ?>
									                                        <?php if ($uso_parte=='DOA') {?>
									                                          <option value="DOA">DOA</option>
									                                          <option value="Usado">Usado</option>
									                                          <option value="Nuevo">Nuevo sin usar</option>

									                                          <?php
									                                        } ?>

									</select>
									<label for="s_defec">Serial Defectuoso:</label>
									<input type="text" name="serial_def" value="<?php echo $serial_def ?>">
									<label for="s_defec">Guía Devolución:</label>
									<input type="text" name="serial_guia" value="<?php echo $serial_guia ?>">
									<label for="tecnicos">Fecha Llegada:</label>
									<?php if ($fecha_parte=='0000-00-00 00:00:00') {?>
										<input type="" id="fecha_creacion" class="datetime6" name="fecha_llegada" value="" required><input type="checkbox" id="ver_creacion" class="ver" onChange="hideOrShowPassword()"/>Editar Fecha<br>
									<?php }elseif ($fecha_parte!=='0000-00-00 00:00:00') {?>
										<input type="" id="fecha_creacion" class="datetime6" name="fecha_llegada" value="<?php echo $fecha_parte ?>"><input type="checkbox" id="ver_creacion" class="ver" onChange="hideOrShowPassword()"/>Editar Fecha<br>
									<?php } ?>

               <input type="submit" value="Actualizar" />

  						<input id="cierre" type="button" onclick=" location.href='ver_part_caso.php?caso_id=<?php echo $id_caso ?>&caso_n=<?php echo $num_ca ?>'" value="Regresar " name="regresar" />
  				</form>

  		</section>
  		</container>
  		<footer>
  				<h1>Soporte S.A</h1>

  		</footer>
			<script>
			document.getElementById('reem').onchange = function() {
    document.getElementById('reem_t').disabled = !this.checked;
};

			</script>
    	</body>
      </html>
