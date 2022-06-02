<?php
	error_reporting(0);
	/* Connect To Database*/
	require_once ("../conexion.php");

	
$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
if($action == 'ajax'){
	$query = mysqli_real_escape_string($con,(strip_tags($_REQUEST['query'], ENT_QUOTES)));

	$tables="visitas";
	$campos="*";
	$sWhere="visitas.part_order LIKE '%".$query."%' OR visitas.work_order LIKE '%".$query."%' OR visitas.caso LIKE '%".$query."%'";
	$sWhere.=" order by visitas.caso desc";
	
	
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
						<th>Work Order</th>
                      <th>Caso</th>
                      <th>Part Order</th>
                      <th>Fecha</th>
					</tr>
				</thead>
				<tbody>	
						<?php 
						$finales=0;
						while($row = mysqli_fetch_array($query)){	
								$id_visitas=$row['id_visitas'];
				                $part_order=$row['part_order'];
				                $work_order=$row['work_order'];
				                $caso=$row['caso'];
				                $fecha=$row['fecha'];
				                $part_order1=$row_or['part_order'];
				                $sql_servicio= mysqli_query($con,"SELECT * FROM ordenes_servicio WHERE id_caso='$caso'");
				                $row_ser=mysqli_fetch_assoc($sql_servicio);
				                $num_caso=$row_ser['num_caso'];
							
							$finales++;

				
							
						?>	
						<tr>
							<td><?php echo $work_order ?> </td>
                    <td><?php echo $num_caso ?></td>
                    <td><?php echo $part_order ?></td>
                    <td><?php echo $fecha ?></td>

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
		  
