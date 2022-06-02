<?php
	error_reporting(0);
	/* Connect To Database*/
	require_once ("../conexion.php");

	
$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
if($action == 'ajax'){
	$query = mysqli_real_escape_string($con,(strip_tags($_REQUEST['query'], ENT_QUOTES)));

	$tables="ordenes_servicio";
	$campos="*";
	$sWhere="ordenes_servicio.nombre_clientes LIKE '%".$query."%' OR ordenes_servicio.tipo_servicio LIKE '%".$query."%' OR ordenes_servicio.num_caso LIKE '%".$query."%' OR ordenes_servicio.id_caso LIKE '%".$query."%' OR ordenes_servicio.estado LIKE '%".$query."%' OR ordenes_servicio.ciudad LIKE '%".$query."%'";
	$sWhere.=" order by ordenes_servicio.id_caso desc";
	
	
	include 'pagination.php'; //include pagination file
	//pagination variables
	$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
	$per_page = intval($_REQUEST['per_page']); //how much records you want to show
	$adjacents  = 4; //gap between pages after number of adjacents
	$offset = ($page - 1) * $per_page;
	//Count the total number of row in your table*/
	$count_query   = mysqli_query($con,"SELECT count(*) AS numrows FROM $tables where $sWhere ");
	if ($row= mysqli_fetch_array($count_query)){$numrows = $row['numrows'];}
	else {echo mysqli_error($con);}
	$total_pages = ceil($numrows/$per_page);
	//main query to fetch the data
	$query = mysqli_query($con,"SELECT $campos FROM  $tables where $sWhere LIMIT $offset,$per_page");
	//loop through fetched data
	


		
	
	if ($numrows>0){
		
	?>
		<div class="table-responsive">
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th class='text-center'>ID</th>
						<th>Numero Caso</th>
						<th>Estado</th>
						<th>Cliente</th>
						<th>Ciudad</th>
						<th>Work Order</th>
						<th>Serial Equipo</th>
						<th>Fecha Recibido</th>
					</tr>
				</thead>
				<tbody>	
						<?php 
						$finales=0;
						while($row = mysqli_fetch_array($query)){	

							$id_caso=$row['id_caso'];
								$sql_or = mysqli_query($con,"SELECT * FROM  visitas where caso='$id_caso'");
								$row_or=mysqli_fetch_assoc($sql_or);
								$work_or=$row_or['work_order'];
								$part_or=$row_or['part_order'];
							$id_serial_equipos=$row['id_serial_equipos'];
								$sql_equipos= mysqli_query($con,"SELECT * FROM equipos WHERE id_equipo='$id_serial_equipos'");
               					 $row_equ=mysqli_fetch_assoc($sql_equipos);
               					 $serial_equipo=$row_equ['serial_equipo'];
							$num_caso=$row['num_caso'];
							$estado=$row['estado'];
							$nombre_clientes=$row['nombre_clientes'];
							$contacto=$row['contacto'];
							$ciudad=$row['ciudad'];
							$fecha_creacion=$row['fecha_creacion'];
							$finales++;

							$sql_cas= mysqli_query($con,"SELECT * FROM ordenes_servicio WHERE id_caso='$id_caso'");
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
										$sql_re= mysqli_query($con,"SELECT DISTINCT partes.estado_parte FROM repuestos,partes WHERE repuestos.part_order='$part_or' AND partes.id_partes=repuestos.no_parte");

										while ($row_re=mysqli_fetch_assoc($sql_re)) {

												$no_parte_re=$row_re['estado_parte'];
												if ($no_parte_re=='') {
													mysqli_query($con,"UPDATE ordenes_servicio SET estado='Requiere repuesto',fecha_creacion='$fecha_creacion',fecha_recibido='$fecha_recibido',fecha_onsite='$fecha_onsite',fecha_repair='$fecha_repair',fecha_cierre='$fecha_cierre' WHERE num_caso='$num_caso'");
													break;
												}elseif ($no_parte_re=='Disponible') { 
												  mysqli_query($con,"UPDATE ordenes_servicio SET estado='Repuestos OK',fecha_creacion='$fecha_creacion',fecha_recibido='$fecha_recibido',fecha_onsite='$fecha_onsite',fecha_repair='$fecha_repair',fecha_cierre='$fecha_cierre' WHERE num_caso='$num_caso'");
													break;
												}

										}
									}					
							
						?>	
						<tr>
							<td class='text-center'><?php echo $id_caso;?></td>
							<td class='text-center'><a href="javascript: void(0);" onclick="parent.window.location='../edita_orden.php?num_caso=<?php echo $id_caso ?>'"><?php echo $num_caso;?></a></td>
							<td ><?php echo $estado;?></td>
							<td ><?php echo $nombre_clientes;?></td>							
							<td><?php echo $ciudad;?></td>
							<td ><?php echo $work_or;?></td>
							<td><?php echo $serial_equipo;?></td>
							<td><?php echo $fecha_creacion;?></td>
							<td>								
									
									<a href="javascript: void(0);" onclick="parent.window.location='../edita_orden.php?num_caso=<?php echo $id_caso ?>'"><i class="material-icons" data-toggle="tooltip" title="Editar" >&#xE254;</i></a>
								
                    		</td>

						</tr>
						<?php }?>
						<tr>
							<td colspan='6'> 
								<?php 
									$inicios=$offset+1;
									$finales+=$inicios -1;
									echo "Mostrando $inicios al $finales de $numrows registros";
									echo paginate( $page, $total_pages, $adjacents);
								?>
							</td>
						</tr>
				</tbody>			
			</table>
		</div>	

	
	
	<?php	
	}	
}
?>          
		  
