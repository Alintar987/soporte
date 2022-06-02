
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
$sql_caso= mysqli_query($conec,"SELECT * FROM visitas WHERE caso='$id_caso' ");
$sql_ca= mysqli_query($conec,"SELECT * FROM visitas WHERE caso='$id_caso'");


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
							<?php while ($row_caso=mysqli_fetch_assoc($sql_caso)) {
								$caso_visitas=$row_caso['part_order'];
								$work_order_v=$row_caso['work_order'];
							?>
							 <?php } ?>
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


                <?php
								while ($row_ca=mysqli_fetch_assoc($sql_ca)) {
									$caso_vi=$row_ca['part_order'];
									$sql_rep= mysqli_query($conec,"SELECT  * FROM repuestos WHERE part_order='$caso_vi'");
								while ($row_rep=mysqli_fetch_assoc($sql_rep)) {
									$estado_parte=$row_rep['estado_parte'];
                $no_parte=$row_rep['no_parte'];
								$uso_parte=$row_rep['uso_parte'];
								$part_order_rep=$row_rep['part_order'];


								$sql_parte= mysqli_query($conec,"SELECT * FROM partes WHERE id_partes='$no_parte'");
								$row_part=mysqli_fetch_assoc($sql_parte);
								$no_parte_p=$row_part['no_parte'];
								$descripcion=$row_part['descripcion'];

								$sql_wor= mysqli_query($conec,"SELECT * FROM visitas WHERE part_order='$part_order_rep'");
								$row_wor=mysqli_fetch_assoc($sql_wor);
								$work_order_wor=$row_wor['work_order'];



                ?>
                <tr>
										<td style="padding: 4px;"> <strong>	<?php echo $work_order_wor ?><br><?php echo $part_order_rep; ?></strong></td>
                    <td style="padding: 4px;"> <?php echo $no_parte_p; ?></td>
                    <td style="padding: 4px;"><?php echo $descripcion ?></td>
                    <td style="padding: 4px;"> <?php if ($estado_parte=='Disponible') {
                    	echo "<h3>".$estado_parte."</H3>";
                    }else {
                    	echo $estado_parte;
                    } ?></td>
										<td>
											<form name="tecnicos" method="POST" action="php/upda_part.php">
											<input type="hidden" name="num_ca" value="<?php echo $num_ca ?>">
													<input type="hidden" name="id_caso" value="<?php echo $id_caso ?>">
												<input type="hidden" name="no_parte" value="<?php echo $no_parte ?>">
												<input type="hidden" name="caso_visitas" value="<?php echo $caso_visitas ?>">
												<input type="hidden" name="part_order" value="<?php echo $part_order_rep ?>">
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
											<input type="hidden" name="po" value="<?php echo $part_order_rep ?>">
											<input type="hidden" name="parte_id" value="<?php echo $no_parte ?>">
											<input type="hidden" name="num_ca" value="<?php echo $num_ca ?>">
											<input type="hidden" name="id_caso" value="<?php echo $id_caso ?>">
											<input type="submit" name="" value="Editar">
										</form>
									</td>
                </tr>
                <?php
                }
								}?>
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
