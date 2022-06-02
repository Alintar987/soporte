
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
$sql_ordenes= mysqli_query($conec,"SELECT * FROM ordenes_servicio");
 ?>

<!DOCTYPE html>
<html lang="es">

<?php include ("url/head.php"); ?>
<script src="../css/jquery.js"></script>
<link rel="stylesheet" type="text/css" href="../css/DataTables/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="../css/DataTables/js/jquery.dataTables.js"></script>
<body >
		<section id="containerr">

				<form name="tecnicos" method="POST" action= "" id="tecnicoss">

          <table id="ver_orden" class="display" cellspacing="0" width="100%">
              <thead>
                  <tr>
											<th>ID</th>
                      <th>Numero Caso</th>
                      <th>Estado</th>
                      <th>Cliente</th>
											<th>Ciudad</th>
                      <th>Tipo Servicio</th>
											<th>Work Order</th>
                      <th>Serial Equipo</th>
                      <th>Fecha Recibido</th>
                  </tr>
              </thead>
              <tbody>
                <?php while ($row=mysqli_fetch_assoc($sql_ordenes)) {
                  $id_caso=$row['id_caso'];
                $num_caso=$row['num_caso'];
                $estado=$row['estado'];


								$sql_or= mysqli_query($conec,"SELECT * FROM visitas WHERE caso='$id_caso'");
								$row_or=mysqli_fetch_assoc($sql_or);
								  $part_or=$row_or['part_order'];
									$sql_cas= mysqli_query($conec,"SELECT * FROM ordenes_servicio WHERE id_caso='$id_caso'");
									$row_cas=mysqli_fetch_assoc($sql_cas);
									 $part_cas=$row_cas['estado'];
									 $fecha_creacion=$row_cas['fecha_creacion'];
									 $fecha_recibido=$row_cas['fecha_recibido'];
									 $fecha_onsite=$row_cas['fecha_onsite'];
									 $fecha_repair=$row_cas['fecha_repair'];
									 $fecha_cierre=$row_cas['fecha_cierre'];
									 if ($part_cas=='Fix time' || $part_cas=='Caso cerrado' || $part_cas=='Pendiente proveedor') {
									 	# code...
									}else {
										$sql_re= mysqli_query($conec,"SELECT DISTINCT partes.estado_parte FROM repuestos,partes WHERE repuestos.part_order='$part_or' AND partes.id_partes=repuestos.no_parte");
										while ($row_re=mysqli_fetch_assoc($sql_re)) {

												$no_parte_re=$row_re['estado_parte'];
												if ($no_parte_re=='') {
													mysqli_query($conec,"UPDATE ordenes_servicio SET estado='Requiere repuesto',fecha_creacion='$fecha_creacion',fecha_recibido='$fecha_recibido',fecha_onsite='$fecha_onsite',fecha_repair='$fecha_repair',fecha_cierre='$fecha_cierre' WHERE num_caso='$num_caso'");
													break;
												}elseif ($no_parte_re=='Disponible') {
												  mysqli_query($conec,"UPDATE ordenes_servicio SET estado='Repuestos OK',fecha_creacion='$fecha_creacion',fecha_recibido='$fecha_recibido',fecha_onsite='$fecha_onsite',fecha_repair='$fecha_repair',fecha_cierre='$fecha_cierre' WHERE num_caso='$num_caso'");
													break;
												}

										}
									}






								$ciudad=$row['ciudad'];
                $tipo_servicio=$row['tipo_servicio'];
                $id_clientes_servicio=$row['id_clientes_servicio'];
                $fecha_creacion=$row['fecha_creacion'];
                $id_serial_equipos=$row['id_serial_equipos'];
								$nombre_clientes=$row['nombre_clientes'];
                $sql_equipos= mysqli_query($conec,"SELECT * FROM equipos WHERE id_equipo='$id_serial_equipos'");
                $row_equ=mysqli_fetch_assoc($sql_equipos);
                $serial_equipo=$row_equ['serial_equipo'];



                ?>
                <tr>
										<td><?php echo $id_caso ?></td>
                    <td> <a href="edita_orden.php?num_caso=<?php echo $id_caso ?>"> <?php echo $num_caso ?></a></td>
                    <td><?php echo $estado ?></td>
                    <td><?php echo $nombre_clientes ?></td>
										<td><?php echo $ciudad ?></td>
                    <td><?php echo $tipo_servicio ?></td>
										<td>
											<?php
											$sql_wo= mysqli_query($conec,"SELECT work_order FROM visitas WHERE caso='$id_caso'");
											while ($row_wo=mysqli_fetch_assoc($sql_wo)) {
												echo "<br>".$work_order=$row_wo['work_order'];
											};

											 ?></td>
                    <td><?php echo $serial_equipo ?></td>
                      <td><?php echo $fecha_creacion ?></td>
                </tr>
                <?php
                } ?>

              </tbody>
            </table>
				</form>

		</section>
		</container>
    <script type="text/javascript">
    $(document).ready(function() {
    $('#ver_orden').DataTable(
			{"pageLength": 5}
		);
} );

    </script>
  	</body>
    </html>
