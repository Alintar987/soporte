
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
 ?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>CRUD de productos con PHP - MySQL - jQuery AJAX </title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="css/custom.css">
</head>
<body>

    <div class="container">
        <div class="table-wrapper">
			<div class='col-sm-4 pull-right'>
				<div id="custom-search-input">
                            <div class="input-group col-md-12">
                                <input type="text" class="form-control" placeholder="Buscar"  id="q" onkeyup="load(1);" />
                                <span class="input-group-btn">
                                    <button class="btn btn-info" type="button" onclick="load(1);">
                                        <span class="glyphicon glyphicon-search"></span>
                                    </button>
                                </span>
                            </div>
                </div>
			</div>
			<div class='clearfix'></div>
			<hr>
			<div id="loader"></div><!-- Carga de datos ajax aqui -->
			<div id="resultados"></div><!-- Carga de datos ajax aqui -->
			<div class='outer_div'></div><!-- Carga de datos ajax aqui -->
            
			
        </div>
    </div>
	<!-- Edit Modal HTML -->
	<?php include("html/modal_edit.php");?>
	<!-- Delete Modal HTML -->
	<?php include("html/modal_delete.php");?>
	<script src="js/script.js"></script>

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
											<th style="width: 170px;">Work Order</th>
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
									 $contacto=$row_cas['contacto'];
									 $direccion=$row_cas['direccion'];
									 $telefono=$row_cas['telefono'];

									 if ($part_cas=='Fix time' || $part_cas=='Caso cerrado' || $part_cas=='Pendiente proveedor' || $part_cas=='Anulado' || $part_cas=='Inconcluso') {
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
										<td style="width: 170px;">
											<?php
											$sql_wo= mysqli_query($conec,"SELECT work_order,part_order FROM visitas WHERE caso='$id_caso'");
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
  	</body>
</body>
</html>                                		                            