<?php
include_once "conexion.php";
//$fecha_creacion=$_POST["fecha_creacion"];
//echo $fecha_creacion;


$id_partes=$_GET["parte_id"];

$sql = " DELETE FROM partes WHERE id_partes='$id_partes'";

   if (mysqli_query($con, $sql)) {
		 echo '<script>
 				alert("Parte Borrada Correctamente.");
 				window.location="../ver_partes.php";
 			</script>';
 			exit;
   } else {
      echo "Error updating record: " . mysqli_error($con);
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
