<?php

$con=@mysqli_connect('localhost', 'root', '', 'ordenes');
if(!$con){
    die("imposible conectarse: ".mysqli_error($con));
}
if (@mysqli_connect_errno()) {
    die("Connect failed: ".mysqli_connect_errno()." : ". mysqli_connect_error());
}
//$cel=2;//Numero de fila donde empezara a crear  el reporte

foreach($_POST['part_order'] as $part_order) {

$sql="SELECT ordenes_servicio.id_caso,ordenes_servicio.num_caso,ordenes_servicio.estado,ordenes_servicio.nombre_clientes,ordenes_servicio.ciudad,visitas.work_order,visitas.part_order,equipos.serial_equipo,ordenes_servicio.contacto,ordenes_servicio.direccion,ordenes_servicio.telefono,ordenes_servicio.fecha_recibido FROM ordenes_servicio,visitas,equipos,repuestos WHERE visitas.part_order='$part_order' AND repuestos.part_order=visitas.part_order AND ordenes_servicio.id_caso=visitas.caso AND equipos.id_equipo=ordenes_servicio.id_serial_equipos";
$query=mysqli_query($con,$sql);
$row=mysqli_fetch_array($query);
$id_caso=$row['id_caso'];
$num_caso=$row['num_caso'];
$estado=$row['estado'];
$nombre_clientes=$row['nombre_clientes'];
$ciudad=$row['ciudad'];
$serial_equipo=$row['serial_equipo'];
$work_order=$row['work_order'];
$part_order=$row['part_order'];
$contacto=$row['contacto'];
$direccion=$row['direccion'];
$telefono=$row['telefono'];
$fecha_recibido=$row['fecha_recibido'];
}
 ?>
