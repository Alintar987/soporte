
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
$id_caso=$_GET['caso_id'];
$num_ca=$_GET['caso_n'];
$sql_caso= mysqli_query($conec,"SELECT DISTINCT repuestos.id_repuestos,visitas.part_order,visitas.work_order,repuestos.no_parte,partes.no_parte,partes.descripcion,repuestos.estado_parte,repuestos.uso_parte FROM visitas,repuestos,partes WHERE visitas.caso='$id_caso' AND repuestos.part_order=visitas.part_order AND repuestos.no_parte=partes.id_partes");


 ?>

<!DOCTYPE html>
<html lang="es">

<?php include ("url/head.php"); ?>
<script src="../css/jquery.js"></script>
<link rel="stylesheet" type="text/css" href="../css/DataTables/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="../css/DataTables/js/jquery.dataTables.js"></script>
<body>
		<section id="container">


						<div class="">
							<h2>Caso N°: <?php echo $num_ca ?></h2>

						</div>
          <table border="1" id="tabla_parte" class="display" cellspacing="0" style="width:100%">
              <thead>
								<tr>
									<th style="padding: 2px; width:16%">Item</th>
									<th style="padding: 2px; width:15%" >N° Parte</th>
									<th style="padding: 2px;">Descripción</th>
									<th style="padding: 2px;">Estado</th>
									<th style="padding: 2px;">Opción</th>
									<th style="padding: 2px;">Editar</th>
								</tr>
              </thead>
              <tbody>

								<?php while ($row_caso=mysqli_fetch_assoc($sql_caso)) {
									$id_repuestos=$row_caso['id_repuestos'];
									$visitas_part=$row_caso['part_order'];
									$work_order_v=$row_caso['work_order'];
									$no_parte=$row_caso['no_parte'];
									$descripcion=$row_caso['descripcion'];
									$estado_parte=$row_caso['estado_parte'];
									$uso_parte=$row_caso['uso_parte'];
								?>


                <tr>
										<td style="padding: 4px;"> <strong>	<?php echo $work_order_v ?><br><?php echo $visitas_part; ?></strong></td>
                    <td style="padding: 4px;"> <?php echo $no_parte; ?></td>
                    <td style="padding: 4px;"><?php echo $descripcion ?></td>
                    <td style="padding: 4px;"> <?php if ($estado_parte=='Disponible') {
                    	echo "<h3>".$estado_parte."</H3>";
                    }else {
                    	echo $estado_parte;
                    } ?></td>
										<td>
											<form name="tecnicos" method="POST" action="php/upda_part.php">
												<input type="hidden" name="id_repuestos" value="<?php echo $id_repuestos ?>">
											<input type="hidden" name="num_ca" value="<?php echo $num_ca ?>">
													<input type="hidden" name="id_caso" value="<?php echo $id_caso ?>">
												<input type="hidden" name="no_parte" value="<?php echo $no_parte ?>">
												<input type="hidden" name="part_order" value="<?php echo $visitas_part ?>">

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
										<input type="submit" value="Actualizar" />
										</form>


									</td>
									<td>
										<form  action="edita_parte_c.php" method="GET">
											<input type="hidden" name="id_repuestos" value="<?php echo $id_repuestos ?>">
											<input type="hidden" name="po" value="<?php echo $visitas_part ?>">
											<input type="hidden" name="parte_id" value="<?php echo $no_parte ?>">
											<input type="hidden" name="num_ca" value="<?php echo $num_ca ?>">
											<input type="hidden" name="id_caso" value="<?php echo $id_caso ?>">
											<input type="submit" name="" value="Editar">
										</form>
									</td>
                </tr>
								<?php } ?>
              </tbody>
            </table>
            <input id="cierre" type="button" onclick=" location.href='edita_orden.php?num_caso=<?php echo $id_caso ?>'" value="Regresar " name="regresar" />


		</section>
		</container>
		<script type="text/javascript">
		$(document).ready(function() {
		$('#tabla_parte').DataTable({
			"paging":   false,
			"ordering": false,
        "info":     false
		});
} );

		</script>

  	</body>
    </html>
