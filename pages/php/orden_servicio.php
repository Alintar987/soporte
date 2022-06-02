<?php
include_once "conexion.php";
//$fecha_creacion=$_POST["fecha_creacion"];
//echo $fecha_creacion;




$caso=$_POST["caso"];
$estado=$_POST["estado"];
$fecha_creacion=$_POST["fecha_creacion"];
$fecha_creacion1=date("Y-m-d H:i",strtotime($fecha_creacion));
$fecha_recibido=$_POST["fecha_recibido"];
$fecha_recibido1=date("Y-m-d H:i",strtotime($fecha_recibido));
$fecha_onsite=$_POST["fecha_onsite"];
$fecha_onsite1=date("Y-m-d H:i",strtotime($fecha_onsite));
$fecha_repair=$_POST["fecha_repair"];
$fecha_repair1=date("Y-m-d H:i",strtotime($fecha_repair));
$fecha_cierre=$_POST["fecha_cierre"];
$fecha_cierre1=date("Y-m-d H:i",strtotime($fecha_cierre));

$nombre_cliente=$_POST["nombre_cliente"];
$contacto=$_POST["contacto"];
$ciudad=$_POST["ciudad"];
$direccion=$_POST["direccion"];
$telefono=$_POST["telefono"];
$movil=$_POST["movil"];
$email=$_POST['email'];

$serial_equipos=$_POST["serial_equipos"];
$descripcion_servicio=$_POST["descripcion_servicio"];
$sol_servicio=$_POST["sol_servicio"];
$tipo_servicio=$_POST["pago"];
$fecha_real=$_POST["fecha_real"];
$tecnico_diagnostico=$_POST["tecnico_diagnostico"];
$tecnico_solucion=$_POST["tecnico_solucion"];


$insertar = "INSERT INTO ordenes_servicio	 VALUES ('','$caso','$estado','$fecha_creacion1','$fecha_recibido1','$fecha_onsite1','$fecha_repair1','$fecha_cierre1','$nombre_cliente','$contacto','$ciudad','$direccion','$telefono','$movil','$email','$serial_equipos','$descripcion_servicio','$sol_servicio','$tipo_servicio','$fecha_real','$tecnico_diagnostico','$tecnico_solucion')";



$validacion = mysqli_query($con, "SELECT * FROM ordenes_servicio WHERE num_caso='$caso'");

if (mysqli_num_rows($validacion)>0) {
	echo '<script>
			alert("Este caso ya esta Registrado.");
			window.history.go(-1);
		</script>';
		exit;
}




// ejecutar consulta
$resultado = mysqli_query($con,$insertar);

if (!$resultado) {
	echo'<script>
			alert("Error al registrar. Si el problema continua, intente mas tarde");
			window.history.go(-1);
		</script>';
		exit;
}else {
	echo '<script>
			alert("Caso registrado Correctamente.");
			window.location="../admin.php";
		</script>';
		exit;
}

//cerrar conexion base de datos

mysqli_close($con);





  ?>
