<?php
include_once "conexion.php";
//$fecha_creacion=$_POST["fecha_creacion"];
//echo $fecha_creacion;
$id_re=$_POST['id_re'];
$po=$_POST['po'];
$serial_parte=$_POST['serial_parte'];
$serial_def=$_POST['serial_def'];
$serial_guia=$_POST['serial_guia'];
$uso_parte=$_POST['uso_parte'];
$id_partes=$_POST["id_partes"];
$caso=$_POST["caso"];
$estado=$_POST["estado"];

$fecha_llegada=$_POST["fecha_llegada"];
if (isset($_POST["reem"])) {
  $reem=$_POST["reem"];
  $sql = " UPDATE partes,repuestos SET repuestos.part_reem='$reem' ,repuestos.fecha_parte='$fecha_llegada',repuestos.estado_parte='$estado',repuestos.uso_parte='$uso_parte',repuestos.serial_parte='$serial_parte',repuestos.serial_def='$serial_def', repuestos.serial_guia='$serial_guia' WHERE repuestos.id_repuestos='$id_re' AND repuestos.no_parte='$id_partes' AND repuestos.part_order='$po'";

     if (mysqli_query($con, $sql)) {
  		 echo '<script>
   				alert("Parte Actualizada Correctamente.");
   				window.location="../repuestos.php";
   			</script>';
   			exit;
     } else {
        echo "Error updating record: " . mysqli_error($con);
     }
}else {
  $sql = " UPDATE partes,repuestos SET repuestos.fecha_parte='$fecha_llegada',repuestos.estado_parte='$estado',repuestos.uso_parte='$uso_parte',repuestos.serial_parte='$serial_parte',repuestos.serial_def='$serial_def',repuestos.serial_guia='$serial_guia' WHERE repuestos.id_repuestos='$id_re' AND repuestos.no_parte='$id_partes' AND repuestos.part_order='$po'";

     if (mysqli_query($con, $sql)) {
  		 echo '<script>
   				alert("Parte Actualizada Correctamente.");
   				window.location="../repuestos.php";
   			</script>';
   			exit;
     } else {
        echo "Error updating record: " . mysqli_error($con);
     }
  # code...
}




// ejecutar consulta

/*

$insertar = "UPDATE ordenes_servicio SET estado='$estado',fecha_recibido='$fecha_recibido',fecha_onsite='$fecha_onsite',fecha_repair='$fecha_repair',fecha_cierre='$fecha_cierre',descripcion_servicio='$descripcion_servicio',id_tecnico_servicio='$tecnico_diagnostico',id_tecnico_solucion='$tecnico_solucion' WHERE caso='$caso'";
mysqli_query($con,$insertar);
$resultado =
if (!$resultado) {
	echo'<script>
			alert("Error al Actualizar. Si el problema continua, intente mas tarde");
			window.history.go(-1);
		</script>';
		exit;
}else {
	echo '<script>
			alert("Caso Actualizado Correctamente.");
			window.location="../ver_orden_servicio.php";
		</script>';
		exit;
}
//cerrar conexion base de datos

mysqli_close($con);
*/



  ?>
