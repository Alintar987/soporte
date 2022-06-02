<?php
include_once "conexion.php";
//$fecha_creacion=$_POST["fecha_creacion"];
//echo $fecha_creacion;
if (isset($_POST['fecha_contrato'])) {
    $fecha_contrato=$_POST['fecha_contrato'];
    $id_caso=$_POST["id_caso"];
    $caso=$_POST["caso"];
    $estado=$_POST["estado"];
    $fecha_creacion=$_POST["fecha_creacion"];
    $fecha_recibido=$_POST["fecha_recibido"];
    $fecha_onsite=$_POST["fecha_onsite"];
    $fecha_repair=$_POST["fecha_repair"];
    $fecha_cierre=$_POST["fecha_cierre"];


    $nombre_cliente=$_POST["nombre_cliente"];
    $contacto=$_POST["contacto"];
    $ciudad=$_POST["ciudad"];
    $direccion=$_POST["direccion"];
    $telefono=$_POST["telefono"];
    $movil=$_POST["movil"];
    $email=$_POST['email'];

    $descripcion_servicio=$_POST["descripcion_servicio"];
    $sol_servicio=$_POST["sol_servicio"];
    $tecnico_diagnostico=$_POST["tecnico_diagnostico"];
    $tecnico_solucion=$_POST["tecnico_solucion"];

    $sql = " UPDATE ordenes_servicio SET  estado='$estado',fecha_creacion='$fecha_creacion',fecha_recibido='$fecha_recibido',fecha_onsite='$fecha_onsite',fecha_repair='$fecha_repair',fecha_cierre='$fecha_cierre',fecha_contrato='$fecha_contrato',contacto='$contacto',ciudad='$ciudad',direccion='$direccion',telefono='$direccion',telefono='$telefono',movil='$movil',email='$email',descripcion_servicio='$descripcion_servicio',sol_servicio='$sol_servicio',id_tecnico_servicio='$tecnico_diagnostico',id_tecnico_solucion='$tecnico_solucion'  WHERE num_caso='$caso'";

       if (mysqli_query($con, $sql)) {
    		 echo '<script>
     				alert("Caso Actualizado Correctamente.");
     				window.location="../edita_orden.php?num_caso='.$id_caso.'";
     			</script>';
     			exit;
       } else {
          echo "Error updating record: " . mysqli_error($con);
       }

}else {

  $id_caso=$_POST["id_caso"];
  $caso=$_POST["caso"];
  $estado=$_POST["estado"];
  $fecha_creacion=$_POST["fecha_creacion"];
  $fecha_recibido=$_POST["fecha_recibido"];
  $fecha_onsite=$_POST["fecha_onsite"];
  $fecha_repair=$_POST["fecha_repair"];
  $fecha_cierre=$_POST["fecha_cierre"];


  $nombre_cliente=$_POST["nombre_cliente"];
  $contacto=$_POST["contacto"];
  $ciudad=$_POST["ciudad"];
  $direccion=$_POST["direccion"];
  $telefono=$_POST["telefono"];
  $movil=$_POST["movil"];
  $email=$_POST['email'];

  $descripcion_servicio=$_POST["descripcion_servicio"];
  $sol_servicio=$_POST["sol_servicio"];
  $tecnico_diagnostico=$_POST["tecnico_diagnostico"];
  $tecnico_solucion=$_POST["tecnico_solucion"];

  $sql = " UPDATE ordenes_servicio SET estado='$estado',fecha_creacion='$fecha_creacion',fecha_recibido='$fecha_recibido',fecha_onsite='$fecha_onsite',fecha_repair='$fecha_repair',fecha_cierre='$fecha_cierre',contacto='$contacto',ciudad='$ciudad',direccion='$direccion',telefono='$direccion',telefono='$telefono',movil='$movil',email='$email',descripcion_servicio='$descripcion_servicio',sol_servicio='$sol_servicio',id_tecnico_servicio='$tecnico_diagnostico',id_tecnico_solucion='$tecnico_solucion'  WHERE num_caso='$caso'";

     if (mysqli_query($con, $sql)) {
  		 echo '<script>
   				alert("Caso Actualizado Correctamente.");
   				window.location="../edita_orden.php?num_caso='.$id_caso.'";
   			</script>';
   			exit;
     } else {
        echo "Error updating record: " . mysqli_error($con);
     }

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
